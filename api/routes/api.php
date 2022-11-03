<?php

use App\Http\Controllers\API\Admin\UsersController;
use App\Http\Controllers\API\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix("v1")
    ->name("v1.")
    ->group(function(){

        /**
         * Login user 
         */
        Route::post("login", [LoginController::class, "login"])->name("auth.login");


        /**
         * Users  
         */
        Route::apiResource("users", UsersController::class);

    });