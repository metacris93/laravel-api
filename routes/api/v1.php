<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\PostController as PostV1;
use Illuminate\Support\Facades\Route;

Route::apiResource('posts', PostV1::class, ['as' => 'v1'])->middleware('auth:sanctum');
Route::post('login', [LoginController::class, 'login']);
