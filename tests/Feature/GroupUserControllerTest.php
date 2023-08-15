<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupUserControllerTest extends TestCase
{
    use RefreshDatabase; // This will reset the database after each test

    public function testAddUserToGroup()
    {
        // Create an example group and user in the database
        $group = Group::factory()->create();
        $user = User::factory()->create();

        // Make a POST request to add user to the group
        $response = $this->post("/api/groups/{$group->id}/users/{$user->id}");

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the user was added to the group
        $this->assertTrue($group->users->contains($user));
    }

    public function testRemoveUserFromGroup()
    {
        // Create an example group and user in the database
        $group = Group::factory()->create();
        $user = User::factory()->create();

        // Add the user to the group
        $group->users()->attach($user);

        // Make a DELETE request to remove user from the group
        $response = $this->delete("/api/groups/{$group->id}/users/{$user->id}");

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the user was removed from the group
        $this->assertFalse($group->users->contains($user));
    }
}
