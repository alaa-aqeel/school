<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test create new user 
     *
     * @return void
     */
    public function test_create_new_user()
    {

        $fakeUser = User::factory()->raw(["password" => "Test_test%%(99"]);

        $response = $this->postJson("/api/v1/users/", $fakeUser);

        $response
            ->assertStatus(201)
            ->assertJsonPath("message", __("messages.created"))
            ->assertJsonPath("data.is_active", 1);
    }

    /**
     * Test get users 
     * 
     * @return void 
     */
    public function test_get_all_users()
    {
        User::factory(20)->create();

        $response = $this->getJson("/api/v1/users/");

        $response
            ->assertStatus(200)
            ->assertJsonCount(10, "data"); // pagination limit 10 
    }


    /**
     * Test get one user 
     * 
     * @return void 
     */
    public function test_get_one_user()
    {
        $user = User::factory(20)->create()->first();

        $response = $this->getJson("/api/v1/users/{$user->id}");

        $response
            ->assertStatus(200)
            ->assertJsonPath("data.name", $user->name); 
    }


    /**
     * Test update user 
     * 
     * @return void 
     */
    public function test_update_user()
    {
        $user = User::factory()->create();
        $raw = User::factory()->raw();
        
        $response = $this->putJson("/api/v1/users/{$user->id}", [
            "name" => $raw['name'],
            "email" => $raw['email']
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonPath("data.name", $raw['name'])
            ->assertJsonPath("data.email", $raw['email']); 
    }


    /**
     * Test update password 
     * 
     * @return void 
     */
    public function test_update_password_user()
    {
        $user = User::factory()->create();
        
        $response = $this->putJson("/api/v1/users/{$user->id}", [
            "name" => $user->name,
            "email" => $user->email,
            "password" => "tesT_pass2022!",
        ]);

        $response->assertStatus(200); 

        $this->assertTrue(Auth::attempt([
            "email" => $user->email,
            "password" => "tesT_pass2022!",
        ]));

    }


    /**
     * Test delete user 
     * 
     * @return void 
     */
    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('users.update', ["user" => $user->id]));

        $response->assertStatus(204); 
    }
}
