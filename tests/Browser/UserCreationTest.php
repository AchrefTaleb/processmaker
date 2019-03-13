<?php

namespace Tests\Browser;

use Barryvdh\Debugbar\Middleware\DebugbarEnabled;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use ProcessMaker\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserCreationTest extends DuskTestCase
{
    /**
     * @throws \Throwable
     */
    public function testUserCreation()
    {
        $this->markTestSkipped('Skipping Dusk tests temporarily');

        //Factory 100 users
        Artisan::call('migrate:fresh', []);
        $user = factory(User::class)->create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'any@gmail.com',
            'firstname' => 'admin',
            'lastname' => 'admin',
            'timezone' => null,
            'datetime_format' => null,
            'status' => 'ACTIVE',
            'is_administrator' => true,
        ]);
        factory(User::class, 99)->create();
        // Test login
        $this->browse(function (Browser $browser) {

            $browser->resize(1920, 1080);

            $browser->visit('/')
                ->assertSee('Username')
                ->type('#username', 'admin')
                ->type('#password', 'admin')
                ->press('.btn')
                ->clickLink('Admin')
                ->waitUntilMissing('.vuetable-empty-result')
                ->assertSee('1 - 10 of 100 Users');

            $browser->press('#addUserBtn')
                ->type('#username', 'user1')
                ->type('#firstname', 'user1')
                ->type('#lastname', 'last1')
                ->select('select[name="size"]', 'ACTIVE')
                ->type('#email', 'user1@hotmail.com')
                ->type('#password', 'password123')
                ->type('#confpassword', 'password123');

            $browser->maximize();
            $browser->press('.ml-2')
                ->waitFor('.alert-dismissible', 10)
                ->assertSee('successfully created');
        });

    }
}
