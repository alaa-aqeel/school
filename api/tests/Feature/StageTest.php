<?php

namespace Tests\Feature;

use App\Models\Division;
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

        // dd($response->json());
        $response
            ->assertStatus(200)
            ->assertJsonCount(10, "data");
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

    /**
     * Test relate between division an stages 
     * 
     * @return void 
     */
    public function test_relate_with_division_sync()
    {   
        $divisionsIds = Division::factory(3)->create()->pluck("id"); // get only ids

        $response = $this->postJson(route('stages.store'), [
                "name" => "test name",
                "divisions" => $divisionsIds
            ]);

        $response
            ->assertStatus(201)
            ->assertJsonPath("data.name", "test name")
            ->assertJsonCount(3, "data.divisions")
            ->assertJsonPath("message", __("messages.created"));
    }
}
