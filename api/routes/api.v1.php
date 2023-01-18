<?php

use App\Http\Controllers\API\Admin\DivisionController;
use App\Http\Controllers\API\Admin\StageController;
use App\Http\Controllers\API\Admin\UsersController;
use App\Http\Controllers\API\Auth\LoginController;
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


/**
 * Login user 
 * 
 */
Route::post("/auth/login", [LoginController::class, "login"])->name("auth.login");


/**
 * Users  
 * 
 */
Route::apiResource("users", UsersController::class);

/**
 * Stage   
 * 
 */
Route::apiResource("stages", StageController::class);

/**
 * Stage   
 * 
 */
Route::apiResource("divisions", DivisionController::class);
