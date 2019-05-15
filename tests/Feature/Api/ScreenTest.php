<?php

namespace Tests\Feature\Api;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use ProcessMaker\Models\Screen;
use ProcessMaker\Models\User;
use Tests\TestCase;
use Tests\Feature\Shared\RequestHelper;

class ScreenTest extends TestCase
{
    use RequestHelper;

    const API_TEST_SCREEN = '/screens';

    const STRUCTURE = [
        'title',
        'description',
        'config',
    ];

    /**
     * Test verify the parameter required for create screen
     */
    public function testNotCreatedForParameterRequired()
    {
        //Post should have the parameter required
        $url = self::API_TEST_SCREEN;
        $response = $this->apiCall('POST', $url, []);

        //validating the answer is an error
        $response->assertStatus(422);
        $this->assertArrayHasKey('message', $response->json());
    }

    /**
     * Create Form screen successfully
     */
    public function testCreateFormScreen()
    {
        //Post title duplicated
        $faker = Faker::create();
        $url = self::API_TEST_SCREEN;
        $response = $this->apiCall('POST', $url, [
            'title' => 'Title Screen',
            'type' => 'FORM',
            'description' => $faker->sentence(10)
        ]);

        $response->assertStatus(201);
    }

    /**
     * Create Form screen successfully
     */
    public function testCreateDisplayScreen()
    {
        //Post title duplicated
        $faker = Faker::create();
        $url = self::API_TEST_SCREEN;
        $response = $this->apiCall('POST', $url, [
            'title' => 'Title Screen',
            'type' => 'DISPLAY',
            'description' => $faker->sentence(10)
        ]);

        $response->assertStatus(201);
    }


    /**
     * Can not create a screen with an existing title
     */
    public function testNotCreateScreenWithTitleExists()
    {
        factory(Screen::class)->create([
            'title' => 'Title Screen',
        ]);

        //Post title duplicated
        $faker = Faker::create();
        $url = self::API_TEST_SCREEN;
        $response = $this->apiCall('POST', $url, [
            'title' => 'Title Screen',
            'description' => $faker->sentence(10)
        ]);
        $response->assertStatus(422);
        $this->assertArrayHasKey('message', $response->json());
    }

    /**
     * Get a list of Screen in process without query parameters.
     */
    public function testListScreen()
    {
        Screen::query()->delete();
        //add Screen to process
        $faker = Faker::create();
        factory(Screen::class, 10)->create();

        //List Screen
        $url = self::API_TEST_SCREEN;
        $response = $this->apiCall('GET', $url);
        //Validate the answer is correct
        $response->assertStatus(200);
        //verify count of data
        $json = $response->json();
        $this->assertEquals(10, $json['meta']['total']);

        //verify structure paginate
        $response->assertJsonStructure([
            'data',
            'meta',
        ]);
        $this->assertArrayNotHasKey('links', $json);

        //Verify the structure
        $response->assertJsonStructure(['*' => self::STRUCTURE], $json['data']);
    }

    /**
     * Test to verify that the list dates are in the correct format (yyyy-mm-dd H:i+GMT)
     */
    public function testScreenListDates()
    {
        $title = 'testScreenTimezone';
        $newEntity = factory(Screen::class)->create(['title' => $title]);
        $route = self::API_TEST_SCREEN . '?filter=' . $title;
        $response = $this->apiCall('GET', $route);

        $this->assertEquals(
            $newEntity->created_at->format('c'),
            $response->getData()->data[0]->created_at
        );

        $this->assertEquals(
            $newEntity->updated_at->format('c'),
            $response->getData()->data[0]->updated_at
        );
    }

    /**
     * Get a list of Screen with parameters
     */
    public function testListScreenWithQueryParameter()
    {
        $title = 'search Title Screen';
        factory(Screen::class)->create([
            'title' => $title,
        ]);

        //List Screen with filter option
        $perPage = Faker::create()->randomDigitNotNull;
        $query = '?page=1&per_page=' . $perPage . '&order_by=description&order_direction=DESC&filter=' . urlencode($title);
        $url = self::API_TEST_SCREEN . $query;
        $response = $this->apiCall('GET', $url);
        //Validate the answer is correct
        $response->assertStatus(200);
        //verify structure paginate
        $response->assertJsonStructure([
            'data',
            'meta',
        ]);

        $json = $response->json();

        //verify response in meta
        $this->assertEquals(1, $json['meta']['total']);
        $this->assertEquals($perPage, $json['meta']['per_page']);
        $this->assertEquals(1, $json['meta']['current_page']);

        $this->assertEquals($title, $json['meta']['filter']);
        $this->assertEquals('description', $json['meta']['sort_by']);
        $this->assertEquals('DESC', $json['meta']['sort_order']);
        //verify structure of model
        $response->assertJsonStructure(['*' => self::STRUCTURE], $json['data']);
    }

    /**
     * Get a Screen of a process.
     */
    public function testGetScreen()
    {
        //load Screen
        $url = self::API_TEST_SCREEN . '/' . factory(Screen::class)->create([
                'config' => [
                    'field' => 'field 1',
                    'field 2' => [
                        'data1' => 'text',
                        'data2' => 'text 2'
                    ]
                ]
            ])->id;
        $response = $this->apiCall('GET', $url);
        //Validate the answer is correct
        $response->assertStatus(200);

        //verify structure paginate
        $response->assertJsonStructure(self::STRUCTURE);
    }

    /**
     * Update Screen parameter are required
     */
    public function testUpdateScreenParametersRequired()
    {
        //Post should have the parameter title
        $url = self::API_TEST_SCREEN . '/' . factory(Screen::class)->create()->id;
        $response = $this->apiCall('PUT', $url, [
            'title' => '',
            'description' => ''
        ]);
        //Validate the answer is incorrect
        $response->assertStatus(422);
        $this->assertArrayHasKey('message', $response->json());
    }

    /**
     * Update Screen in process successfully
     */
    public function testUpdateScreen()
    {
        //Post saved success
        $faker = Faker::create();
        $yesterday = \Carbon\Carbon::now()->subDay();
        $screen = factory(Screen::class)->create([
            "created_at" => $yesterday,
            "type" => 'FORM',
        ]);
        $original_attributes = $screen->getAttributes();
        $url = self::API_TEST_SCREEN . '/' . $screen->id;
        $response = $this->apiCall('PUT', $url, [
            'title' => 'ScreenTitleTest',
            'description' => $faker->sentence(5),
            'config' => '{"foo":"bar"}',
            'type' => $screen->type,
        ]);

        //Validate the answer is correct
        $response->assertStatus(204);

        // assert it creates a script version
        $screen->refresh();
        $version = $screen->versions()->first();
        $this->assertEquals($version->screen_category_id, $screen->screen_category_id);
        $this->assertEquals($version->title, $original_attributes['title']);
        $this->assertEquals($version->description, $original_attributes['description']);
        $this->assertEquals($version->config, null);
        $this->assertEquals((string)$version->created_at, (string)$yesterday);
        $this->assertLessThan(3, $version->updated_at->diffInSeconds($screen->updated_at));
    }

    /**
     * Update Screen Type
     */
    public function testUpdateScreenType()
    {
        $faker = Faker::create();
        $type = 'FORM';
        $url = self::API_TEST_SCREEN . '/' . factory(Screen::class)->create([
                'type' => $type
            ])->id;
        $response = $this->apiCall('PUT', $url, [
            'title' => 'ScreenTitleTest',
            'type' => 'DETAIL',
            'description' => $faker->sentence(5),
            'config' => '',
        ]);
        $response->assertStatus(204);
    }

    /**
     * Duplicate Screen 
     */
    public function testDuplicateScreen()
    {
        $faker = Faker::create();
        $config = '{"foo":"bar"}';
        $url = self::API_TEST_SCREEN . '/' . factory(Screen::class)->create([
                'config' => $config
            ])->id . '/duplicate';
        $response = $this->apiCall('PUT', $url, [
            'title' => "TITLE",
            'type' => 'FORM',
            'description' => $faker->sentence(5),
        ]);
        $new_screen = Screen::find($response->json()['id']);
        $this->assertEquals($config, $new_screen->config);
    }

    /**
     * Update Screen with same title
     */
    public function testUpdateSameTitleScreen()
    {
        //Post saved success
        $faker = Faker::create();
        $title = 'Some title';
        $url = self::API_TEST_SCREEN . '/' . factory(Screen::class)->create([
                'title' => $title,
                'type' => 'DISPLAY',
            ])->id;
        $response = $this->apiCall('PUT', $url, [
            'title' => $title,
            'description' => $faker->sentence(5),
            'config' => '',
            'type' => 'DISPLAY',
        ]);
        //Validate the answer is correct
        $response->assertStatus(204);
    }

    /**
     * Delete Screen in process
     */
    public function testDeleteScreen()
    {
        //Remove Screen
        $url = self::API_TEST_SCREEN . '/' . factory(Screen::class)->create()->id;
        $response = $this->apiCall('DELETE', $url);
        //Validate the answer is correct
        $response->assertStatus(204);
    }

    /**
     * Delete Screen in process
     */
    public function testDeleteScreenNotExist()
    {
        //screen not exist
        $url = self::API_TEST_SCREEN . '/' . factory(Screen::class)->make()->id;
        $response = $this->apiCall('DELETE', $url);
        //Validate the answer is correct
        $response->assertStatus(405);
    }
    
    /**
     * Server side rendering of email screens
     */
    public function testScreenRender()
    {
        $this->markTestSkipped(
            'api /screens/{id}/render not yet implemented.'
        );
        $screen = factory(Screen::class)->create([
            'type' => 'EMAIL',
            'config' => ''
        ]);
        $url = self::API_TEST_SCREEN . '/' . $screen->id . '/render';
        $data = [
            'foo' => 'bar'
        ];
        $response = $this->apiCall('POST', $url, $data);
        $json = $response->json();
        $this->assertEquals($json['html'], '<div data-server-rendered="true">Test SSR</div>');
    }

}
