<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UsersAccessTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return Auth::guard('sanctum')->user();
})->middleware('auth:sanctum');

Route::apiResource('task',TaskController::class);

Route::post('login',[UsersAccessTokens::class,'store'])
    ->middleware('guest:sanctum');

Route::post('logout',[UsersAccessTokens::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::post('logout-all',[UsersAccessTokens::class,'destroyAll'])
    ->middleware('auth:sanctum');