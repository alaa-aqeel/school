<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Login user 
     * 
     * @param \Illuminate\Http\Request $request 
     * @return \App\Http\Resources\UserResource
     */
    public function store(Request $request)
    {

        $credentials = $request->validate([
                "email" => "required|email",
                "password" => "required"
            ]);

        $credentials['is_active'] = 1;

        if ( Auth::attempt($credentials) ) {

            $user = Auth::user();
            $token = $user->createToken("MSUSER_TOKEN")->plainTextToken;

            $resource = new UserResource($user);
            
            $resource->additional([
                "message" => __("success.login"),
                "access_token" => $token,

            ]);

            return $resource;   
        }


        return response()
            ->json([
                "message" => __("auth.failed")
            ], 401);
    } 

}
