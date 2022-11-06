<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StageRequest;
use App\Http\Resources\StageResource;
use App\Interfaces\StageRepositoryInterface;
use App\Models\Stage;

class StageController extends Controller
{
    /**
     * @var \App\Interfaces\StageRepositoryInterface
     */
    private StageRepositoryInterface $stage;

    function __construct(StageRepositoryInterface $stage)
    {   
        $this->stage = $stage;
        $this->stage->setModel(Stage::class);
    }


    /**
     * Display a listing of the stages.
     *
     * @return \App\Http\Resources\StageResource
     */
    public function index()
    {   
        $stages = $this->stage->all();

        return StageResource::collection($stages);
    }

    /**
     * Store a newly created stages in storage.
     *
     * @param  \App\Http\Requests\StageRequest  $request
     * @return \App\Http\Resources\StageResource
     */
    public function store(StageRequest $request)
    {
        $validated = $request->validated();

        $stage = $this->stage->create($validated);
        
        $resource = new StageResource($stage);
        $resource->additional([
            "message" => __("messages.created")
        ]);

        return $resource->response()->setStatusCode(201);
    }

    /**
     * Display the stage.
     *
     * @param  int  $id
     * @return \App\Http\Resources\StageResource
     */
    public function show($id)
    {
        $stage = $this->stage->get($id);

        return new StageResource($stage);
    }

    /**
     * Update the stage in storage.
     *
     * @param  \App\Http\Requests\StageRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\StageResource
     */
    public function update(StageRequest $request, $id)
    {
        $validated = $request->validated();
        $stage = $this->stage->update($id, $validated);
        $resource = new StageResource($stage);
        $resource->additional([
            "message" => __("messages.updated")
        ]);

        return $resource;
    }

    /**
     * Remove the stage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->stage->delete($id);

        return response()->json([
            "message" => __("messages.deleted")
        ], 204);
    }
}
