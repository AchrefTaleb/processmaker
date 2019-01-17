<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\Shared\RequestHelper;
use ProcessMaker\Models\Process;
use ProcessMaker\Models\User;
use ProcessMaker\Models\ProcessCategory;

class ProcessesTest extends TestCase
{
    use RequestHelper;

    public function testIndex()
    {
        $response = $this->webGet('/processes');
        $response->assertStatus(200);
        $response->assertViewIs('processes.index');
        $response->assertSee('Processes');
    }

    public function testIndexWithOutPermission()
    {
        $this->user = factory(User::class)->create([
            'is_administrator' => false,
        ]);
        $response = $this->webGet('/processes');
        $response->assertStatus(403);
    }

    public function testEdit()
    {
        //Seeder Permissions
        (new \PermissionSeeder())->run($this->user);

        $process = factory(Process::class)->create(['name' => 'Test Edit']);
        $response = $this->webGet('processes/' . $process->id . '/edit');
        $response->assertStatus(200);
        $response->assertViewIs('processes.edit');
        $response->assertSee('Test Edit');
    }

    public function testEditWithOutPermission()
    {
        
        $this->user = factory(User::class)->create([
            'is_administrator' => false,
        ]);
        (new \PermissionSeeder())->run($this->user);

        $process = factory(Process::class)->create(['name' => 'Test Edit']);
        $response = $this->webGet('processes/' . $process->id . '/edit');
        $response->assertStatus(403);
    }

    public function testCreate()
    {
        $process = factory(Process::class)->create(['name' => 'Test Create']);
        $response = $this->webGet('/processes/create');
        $response->assertViewIs('processes.create');
        $response->assertStatus(200);
    }

    public function testCreateWithOutPermission()
    {
        
        $this->user = factory(User::class)->create([
            'is_administrator' => false,
        ]);
        $process = factory(Process::class)->create(['name' => 'Test Create']);
        $response = $this->webGet('/processes/create');
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();
        $response = $this->webCall('POST', '/processes', [
            'name' => 'Stored new user',
            'description' => 'descript',
            'status' => 'ACTIVE'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('processes', ['name' => 'Stored new user']);  // how do I verify DB table name?

    }

    public function testUpdate()
    {
        $process = factory(Process::class)->create(['name' => 'Test Update']);
        $response = $this->webCall('PUT', 'processes/' . $process->id . '', [
            'name' => 'Update Name',
            'description' => 'Descriptionnnnn'
        ]);
        $this->assertDatabaseHas('processes', ['name' => 'Update Name']);
        $response->assertRedirect('/processes');
    }

    public function testDestroy()
    {
        $process = factory(Process::class)->create();
        $response = $this->webCall('DELETE', 'processes/' . $process->id . '');
        $this->assertDatabaseMissing('processes', ['id' => $process->id, 'deleted_at' => null]);
        $response->assertRedirect('/processes');
    }

    public function testArchiveWithOutPermission()
    {
        
        $this->user = factory(User::class)->create([
            'is_administrator' => false,
        ]);
        $process = factory(Process::class)->create();
        $response = $this->webCall('DELETE', 'processes/' . $process->id . '');
        $response->assertStatus(403);
    }
}
