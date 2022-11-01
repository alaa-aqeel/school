<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login .
     *
     * @return void
     */
    public function test_login_successfully()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('v1.auth.login'), $data= [
            "email" => $user->email,
            "password" => '123456789'
        ]); 

        $response->assertStatus(200);
    }

    /**
     * Test login with account not active.
     *
     * @return void
     */
    public function test_login_account_not_active()
    {
        $user = User::factory()->create(['is_active' => 0]);

        $response = $this->postJson(route('v1.auth.login'), $data= [
            "email" => $user->email,
            "password" => '123456789'
        ]); 

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
        $user = User::factory()->create(['password' => '12345678910']);

        $response = $this->postJson(route('v1.auth.login'), [
            "email" => $user->email,
            "password" => '12345678' // password
        ]); 

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
        $user = User::factory()->create();

        $response = $this->postJson(route('v1.auth.login'), [
            "email" => $user->email,
            "password" => '123456789' // password
        ]);     

        $response->assertJsonStructure([
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