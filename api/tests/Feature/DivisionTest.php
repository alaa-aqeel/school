<?php

namespace Tests\Feature;

use App\Models\Division;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DivisionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetach divisions 
     *
     * @return void
     */
    public function test_get_all_divisions()
    {
        Division::factory(10)->create();

        $response = $this->getJson(route('divisions.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(10);
    }

    /**
     * Test create division.
     *
     * @return void
     */
    public function test_create_new_division()
    {
        $response = $this->postJson(route('divisions.store'), ["name" => "test name"]);

        $response
            ->assertStatus(201)
            ->assertJsonPath("data.name", "test name")
            ->assertJsonPath("message", __("messages.created"));
    }



    /**
     * Test update division.
     *
     * @return void
     */
    public function test_update_division()
    {
        $division = Division::factory()->create();

        $response = $this->putJson(route('divisions.update', $division->id), ["name" => "new test name"]);

        $response
            ->assertStatus(200)
            ->assertJsonPath("data.name", "new test name")
            ->assertJsonPath("message", __("messages.updated"));
    }


    /**
     * Test delete division.
     *
     * @return void
     */
    public function test_delete_division()
    {
        $division = Division::factory()->create();

        $response = $this->deleteJson(route('divisions.destroy', $division->id));

        $response->assertStatus(204);
    }

    /**
     * Test not found division.
     *
     * @return void
     */
    public function test_not_found_division()
    {

        $response = $this->deleteJson(route('divisions.destroy', 1000));

        $response->assertStatus(404);
    }
}
