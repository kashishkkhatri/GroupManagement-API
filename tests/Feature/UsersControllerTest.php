<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase; // This will reset the database after each test

    public function testIndex()
    {
        // Create some example users in the database
        User::factory()->count(3)->create();

        // Make a GET request to the index endpoint
        $response = $this->get('/api/users');

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response structure matches the expected JSON structure
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
