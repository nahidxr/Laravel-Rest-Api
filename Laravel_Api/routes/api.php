<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users/{id?}', [UserApiController::class, 'ShowUser']);
Route::post('/add-users', [UserApiController::class, 'AddUser']);
Route::post('/add-multiple-users', [UserApiController::class, 'AddMultipleUser']);
Route::put('/update-user-details/{id}', [UserApiController::class, 'UpdateUserDetails']);
Route::patch('/update-single-record/{id}', [UserApiController::class, 'UpdateSingleRecord']);
Route::delete('/delete-single-user/{id}', [UserApiController::class, 'deleteUser']);
Route::delete('/delete-single-user-with-json', [UserApiController::class, 'deleteUserJson']);
