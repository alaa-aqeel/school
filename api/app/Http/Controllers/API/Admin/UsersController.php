<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{   

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $user;

    function __construct(UserRepositoryInterface $user)
    {   
        $this->user = $user;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\UserResource
     */
    public function index()
    {
        $users = $this->user->all();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \App\Http\Resources\UserResource
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        
        $user = $this->user->create($validated);
        $resource = new UserResource($user);
        $resource->additional([
            "message" => __("messages.created")
        ]);

        return $resource->response()
                ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return new UserResource($this->user->get($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\UserResource
     */
    public function update(UserRequest $request, $id)
    {
        $validated = $request->validated();
        
        $user = $this->user->update($id, $validated);
        $resource = new UserResource($user);
        $resource->additional([
            "message" => __("messages.updated")
        ]);

        return $resource;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->user->delete($id);

        return response()->json([
            "message" => __("messages.deleted")
        ], 204);
    }
}
