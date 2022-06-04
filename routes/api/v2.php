<?php

use App\Http\Controllers\Api\V2\PostController as PostV2;
use Illuminate\Support\Facades\Route;

Route::apiResource('posts', PostV2::class, ['as' => 'v2'])->middleware('auth:sanctum');
