<?php

namespace Tests\Feature;

use App\Models\Stage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StageTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test fetach stages 
     *
     * @return void
     */
    public function test_get_all_stages()
    {
        Stage::factory(10)->create();

        $response = $this->getJson(route('stages.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(10);
    }

    /**
     * Test create stage.
     *
     * @return void
     */
    public function test_create_new_stage()
    {
        $response = $this->postJson(route('stages.store'), ["name" => "test name"]);

        $response
            ->assertStatus(201)
            ->assertJsonPath("data.name", "test name")
            ->assertJsonPath("message", __("messages.created"));
    }



    /**
     * Test update stage.
     *
     * @return void
     */
    public function test_update_stage()
    {
        $stage = Stage::factory()->create();

        $response = $this->putJson(route('stages.update', $stage->id), ["name" => "new test name"]);

        $response
            ->assertStatus(200)
            ->assertJsonPath("data.name", "new test name")
            ->assertJsonPath("message", __("messages.updated"));
    }


    /**
     * Test delete stage.
     *
     * @return void
     */
    public function test_delete_stage()
    {
        $stage = Stage::factory()->create();

        $response = $this->deleteJson(route('stages.destroy', $stage->id));

        $response->assertStatus(204);
    }

    /**
     * Test not found stage.
     *
     * @return void
     */
    public function test_not_found_stage()
    {

        $response = $this->deleteJson(route('stages.destroy', 1000));

        $response->assertStatus(404);
    }
}