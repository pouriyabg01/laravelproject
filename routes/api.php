<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\UsersController;
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


Route::prefix('v1')->group(function () {

    // Users Login & Register Token

    Route::post('register' , [AuthController::class , 'register']);
    Route::post('login' , [AuthController::class , 'login']);


    // END Users Login & Register Token

    // Authenticated Routes

//    Route::middleware('auth:api')->group(function () {
        Route::apiResource('questions' , QuestionsController::class);
        Route::apiResource('users' , UsersController::class);
//    });

    // END Authenticated Routes

});




