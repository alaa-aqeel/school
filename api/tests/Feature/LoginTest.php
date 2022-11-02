<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(array $args = [])  : array 
    {
        $user =  User::factory()->create($args);

        return [
            "email" => $user->email,
            "password" => '12345678'
        ];
    }   

    /**
     * Test login .
     *
     * @return void
     */
    public function test_login_successfully()
    {
        
        $credentials = $this->createUser();

        $response = $this->postJson(route('v1.auth.login'), $credentials); 

        $response->assertStatus(200);
    }

    /**
     * Test login with account not active.
     *
     * @return void
     */
    public function test_login_account_not_active()
    {
        $credentials = $this->createUser(['is_active' => 0]);

        $response = $this->postJson(route('v1.auth.login'), $credentials); 

        $response->assertStatus(401);
        $response->assertJsonPath("message", __("auth.failed"));
    }


    /**
     * Test login with invalid credentials.
     *
     * @return void
     */
    public function test_login_invalid_credentials()
    {
        $credentials = $this->createUser(['password' => '12345678910']);

        $response = $this->postJson(route('v1.auth.login'), $credentials); 

        $response->assertStatus(401);
        $response->assertJsonPath("message", __("auth.failed"));
    }

    /**
     * Test login response.
     *
     * @return void
     */
    public function test_login_structure_response()
    {
        $credentials = $this->createUser();
        
        $response = $this->postJson(route('v1.auth.login'), $credentials);     
        
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "name",
                    "email",
                    "is_active",
                    "is_super",
                    'created_at',
                    'updated_at',
                    "last_login_at"
                ],
                "access_token",
                "message",
            ]);
    }

}
