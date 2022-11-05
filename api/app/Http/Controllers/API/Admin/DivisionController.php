<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * @var \App\Interfaces\BaseRepositoryInterface
     */
    private BaseRepositoryInterface $division;

    function __construct(BaseRepositoryInterface $division)
    {   
        $this->division = $division;
        $this->division->setModel(Division::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response()->json( $this->division->all() );
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
            "name" => "required|string|unique:divisions,name",
        ]);

        $division = $this->division->create($validated);

        return response()->json([
            "data" => $division,
            "message" => __("messages.created")
        ], 201);
    }

    /**
     * Display the division resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $division = $this->division->get($id);

        return response()->json($division);
    }

    /**
     * Update the division resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required|string|unique:divisions,name,".$id,
        ]);

        $division = $this->division->update($id, $validated);

        return response()->json([
            "data" => $division,
            "message" => __("messages.updated")
        ]);
    }

    /**
     * Remove the division resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->division->delete($id);

        return response()->json([
            "message" => __("messages.deleted")
        ], 204);
    }
}
