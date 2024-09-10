<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UsersAccessTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('task',TaskController::class);

Route::post('login',[UsersAccessTokens::class,'store'])
    ->middleware('guest');
