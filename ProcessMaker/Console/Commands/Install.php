<?php
namespace ProcessMaker\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Exception;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Encryption\Encrypter;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

use ProcessMaker\Model\User;

/**
 * Install command handles installing a fresh copy of ProcessMaker BPM.
 * If a .env file is found in the base_path(), then we will refuse to install.
 * Note: This is destructive to your database if you point to an existing database with tables.
 */
class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and configure ProcessMaker 4';

    /**
     * The values for our .env to populate
     *
     * $var array
     */
    private $env;

    /**
     * The encryption key we will use for for fresh install and any encryption during install
     */
    private $key;

    /**
     * Installs a fresh copy of ProcessMaker BPM
     *
     * @return mixed If the command succeeds, true
     */
    public function handle()
    {
        // Setup our initial encryption key and set our running laravel app key to it
        $this->key = 'base64:'.base64_encode(Encrypter::generateKey($this->laravel['config']['app.cipher']));
        config(['app.key' => $this->key]);

        // Our initial .env values
        $this->env = [
            'APP_DEBUG' => 'FALSE',
            'APP_NAME' => 'ProcessMaker',
            'APP_ENV' => 'production',
            'APP_KEY' => $this->key,
            'BROADCAST_DRIVER' => 'redis',
            'BROADCASTER_KEY' => '21a795019957dde6bcd96142e05d4b10',
            'APP_TIMEZONE' => 'UTC',
            'DATE_FORMAT' => '"m/d/Y H:i"',
            'MAIN_LOGO_PATH' => '"/img/processmaker_logo.png"',
            'ICON_PATH_PATH' => '"/img/processmaker_icon.png"',
            'LOGIN_LOGO_PATH' => '"img/processmaker_login.png"'
        ];


        // Configure the filesystem to be local
        config(['filesystems.disks.install' => [
            'driver' => 'local',
            'root' => base_path()
        ]]);

        $this->info("<fg=cyan;bold>" . __("ProcessMaker Installer") . "</>");

        // Determine if .env file exists or not
        // if exists, bail out with an error
        // If file does not exist, begin to generate it
        if(Storage::disk('install')->exists('.env')) {
            $this->error(__("A .env file already exists"));
            $this->error(__("Remove the .env file to perform a new installation"));
            return 255;
        }
        $this->info(__("This application installs a new version of ProcessMaker."));
        $this->info(__("You must have your database credentials available in order to continue."));
        $this->confirm(__("Are you ready to begin?"));
        $this->checkDependencies();
        do {
        $this->fetchDatabaseCredentials();
        } while(!$this->testDatabaseConnection());
        // Ask for URL and validate
        $invalid = false;
        do {
            if($invalid) {
                $this->error(__("The url you provided was invalid. Please provide the scheme, host and path and have no trailing slashes."));
            }
            $this->env['APP_URL'] = $this->ask(__('What is the url of this ProcessMaker installation? (Ex: https://pm.example.com, no trailing slash)'));
        } while($invalid = (!filter_var($this->env['APP_URL'],
                                        FILTER_VALIDATE_URL,
                                        FILTER_FLAG_SCHEME_REQUIRED |
                                        FILTER_FLAG_HOST_REQUIRED)
                    || ($this->env['APP_URL'][strlen($this->env['APP_URL']) - 1] == '/'))
        );
        // Set broadcaster url
        $this->env['BROADCASTER_HOST'] = $this->env['APP_URL'] . ':6001';

        // Set laravel echo server settings
        $this->env['LARAVEL_ECHO_SERVER_AUTH_HOST'] = $this->env['APP_URL'];
        $this->env['LARAVEL_ECHO_SERVER_PORT'] = '6001';
        $this->env['LARAVEL_ECHO_SERVER_DEBUG'] = 'false';

        // Set it as our url in our config
        config(['app.url' => $this->env['APP_URL']]);


        $this->info(__("Installing ProcessMaker database, OAuth SSL keys and configuration file"));

        // The database should already exist and is tested by the fetchDatabaseCredentials call
        // Set the database default connection to install
        config(['database.default' => 'install']);
        \DB::reconnect();

        // Now generate the .env file
        $contents = '';
        // Build out the file contents for our .env file
        foreach($this->env as $key => $value) {
            $contents .= $key . "=" . $value . "\n";
        }
        // Now store it
        Storage::disk('install')->put('.env', $contents);

        // Install migrations
        $this->callSilent('migrate:fresh', [
            '--seed' => true,
        ]);

        $this->info(__("ProcessMaker database installed successfully."));

        // Generate passport secure keys and personal token oauth client
        $this->call('passport:install', [
            '--force' => true
        ]);

		//Create a symbolic link from "public/storage" to "storage/app/public"
        $this->call('storage:link');

        // Restart services so they pick up the new settings
        $this->info(__('Restarting services...'));
        $this->info(e
            system('sudo supervisorctl restart all')
        );

        $this->info(__("ProcessMaker installation is complete. Please visit the url in your browser to continue."));
        return true;
    }


    /**
     * The following checks for required extensions needed by ProcessMaker
     */
    private function checkDependencies()
    {
        $this->info(__("Dependencies Check"));
        $table = new Table($this->output);
        $table->setRows([
          [__('CType Extension'), phpversion('ctype')],
          [__('GD Extension'), phpversion('gd')],
          [__('JSON Extension'), phpversion('json')],
          [__('mbstring Extension'), phpversion('mbstring')],
          [__('OpenSSL Extension'), phpversion('openssl')],
          [__('PDO Extension'), phpversion('pdo')],
          [__('PDO MySQL Extension'), phpversion('pdo_mysql')],
          [__('PHP Version'), phpversion()],
          [__('Tokenizer Extension'), phpversion('tokenizer')],
          [__('XML Extension'), phpversion('xml')],
          [__('ZIP Extension'), phpversion('zip')],

        ]);
        $table->render();
        return true;
    }

    private function fetchDatabaseCredentials()
    {
        $this->info(__("ProcessMaker requires a MySQL database created with appropriate credentials configured."));
        $this->info(__("Refer to the Installation Guide for more information on database best practices."));
        $this->env['DB_HOSTNAME'] = $this->anticipate(__("Enter your MySQL host"), ['localhost']);
        $this->env['DB_PORT'] = $this->anticipate(__("Enter your MySQL port (Usually 3306)"), [3306]);
        $this->env['DB_DATABASE'] = $this->anticipate(__("Enter your MySQL database name"), ['workflow']);
        $this->env['DB_USERNAME'] = $this->ask(__("Enter your MySQL username"));
        $this->env['DB_PASSWORD'] = $this->secret(__("Enter your MySQL password (input hidden)"));
    }

    private function testDatabaseConnection()
    {
        // Setup Laravel Database Configuration
        config(['database.connections.install' => [
            'driver' => 'mysql',
            'host' => $this->env['DB_HOSTNAME'],
            'port' => $this->env['DB_PORT'],
            'database' => $this->env['DB_DATABASE'],
            'username' => $this->env['DB_USERNAME'],
            'password' => $this->env['DB_PASSWORD']
        ]]);
        // Attempt to connect
        try {
            $pdo = DB::connection('install')->getPdo();
        } catch(Exception $e) {
            $this->error(__("Failed to connect to MySQL database. Check your credentials and try again. Note, the database must also exist."));
            return false;
        }
        return true;
    }
}
