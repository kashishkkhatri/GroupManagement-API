<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupControllerTest extends TestCase
{
    use RefreshDatabase; // This will reset the database after each test

    public function testIndex()
    {
        // Create example groups in the database
        Group::factory()->count(3)->create();

        // Make a GET request to the index endpoint
        $response = $this->get('/api/groups');

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response structure matches the expected JSON structure
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'group_code',
                'description',
                'created_at',
                'updated_at',
                'users',
            ],
        ]);
    }

    public function testStore()
    {
        // Make a POST request to create a new group
        $response = $this->post('/api/groups', [
            'name' => 'Test Group',
            'group_code' => 'test123',
            'description' => 'This is a test group',
        ]);

        // Assert that the response has a status code of 201 (Created)
        $response->assertStatus(201);

        // Assert that the response contains the expected data
        $response->assertJson([
            'name' => 'Test Group',
            'group_code' => 'test123',
            'description' => 'This is a test group',
        ]);
    }
    
    public function testShow()
    {
        // Create an example group in the database
        $group = Group::factory()->create();

        // Make a GET request to the show endpoint
        $response = $this->get("/api/groups/{$group->id}");

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains the expected data
        $response->assertJson([
            'id' => $group->id,
            'name' => $group->name,
            'group_code' => $group->group_code,
            'description' => $group->description,
            // Add other expected attributes...
        ]);
    }

    public function testUpdate()
    {
        // Create an example group in the database
        $group = Group::factory()->create();

        // Make a PUT request to update the group
        $response = $this->put("/api/groups/{$group->id}", [
            'name' => 'Updated Group',
            'group_code' => $group->group_code,
            'description' => 'Updated description',
        ]);

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Refresh the group data from the database
        $group->refresh();

        // Assert that the group data has been updated
        $this->assertEquals('Updated Group', $group->name);
        $this->assertEquals('Updated description', $group->description);
    }

    public function testDestroy()
    {
        // Create an example group in the database
        $group = Group::factory()->create();

        // Make a DELETE request to delete the group
        $response = $this->delete("/api/groups/{$group->id}");

        // Assert that the response has a status code of 204 (No Content)
        $response->assertStatus(204);

        // Assert that the group no longer exists in the database
        $this->assertDatabaseMissing('groups', ['id' => $group->id]);
    }

}
