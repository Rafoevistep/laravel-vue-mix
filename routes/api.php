<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\UserController;
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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// put all api protected routes here
Route::middleware('auth:api')->group(function () {
    Route::get('user-detail', [AuthController::class, 'userDetail']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/update/profile', [UserController::class, 'update_profile']);
    Route::put('user/update/password', [UserController::class, 'update_password']);
    Route::delete('user/delete/account',[UserController::class, 'destroy']);
});
