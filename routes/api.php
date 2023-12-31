<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\UserController;
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

Route::group(['prefix' => 'users'], function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('events', [UserController::class, 'events']);
        Route::get('logout', [UserController::class, 'logout']);
        Route::get('', [UserController::class, 'show']);
    });
});

Route::get('events', [EventController::class, 'index']);
