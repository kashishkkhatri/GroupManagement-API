<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GroupUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('users', UsersController::class);
Route::apiResource('groups', GroupController::class);
Route::get('groups/{id}', [GroupController::class, 'show']);
Route::middleware('api')->group(function () {
    Route::post('groups/{groupId}/users/{userId}', [GroupUserController::class, 'addUserToGroup']);
    Route::delete('groups/{groupId}/users/{userId}', [GroupUserController::class, 'removeUserFromGroup']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
