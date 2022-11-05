<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * @var \App\Interfaces\BaseRepositoryInterface
     */
    private BaseRepositoryInterface $stage;

    function __construct(BaseRepositoryInterface $stage)
    {   
        $this->stage = $stage;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response()->json( $this->stage->all() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|unique:stages,name",
        ]);

        $stage = $this->stage->create($validated);

        return response()->json([
            "data" => $stage,
            "message" => __("messages.created")
        ], 201);
    }

    /**
     * Display the stage resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stage = $this->stage->get($id);

        return response()->json($stage);
    }

    /**
     * Update the stage resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required|string|unique:stages,name,".$id,
        ]);

        $stage = $this->stage->update($id, $validated);

        return response()->json([
            "data" => $stage,
            "message" => __("messages.updated")
        ]);
    }

    /**
     * Remove the stage resource from storage.
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
