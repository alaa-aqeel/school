<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    /**
     * on success login 
     * 
     * @return \App\Http\Resources\UserResource
     */
    private function successLogin()
    {
        $user = Auth::user();
        $token = $user->createToken("MSUSER_TOKEN")->plainTextToken;

        $resource = new UserResource($user);

        $resource->additional([
            "message" => __("auth.successfuly"),
            "access_token" => $token,
        ]);

        return $resource; 
    }

    /**
     * on failed login 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    private function failedLogin()
    {
        return response()
            ->json([
                "message" => __("auth.failed")
            ], 401);
    }

    /**
     * Check credentials
     * 
     * @param array $credentials
     * @return bool
     */
    private function attempt(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    /**
     * Login user 
     * 
     * @param \Illuminate\Http\Request $request 
     * @return \App\Http\Resources\UserResource|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $credentials['is_active'] = 1;

        
        return $this->attempt($credentials) 
                ? $this->successLogin()
                : $this->failedLogin();
    } 

}
