<?php

use App\Http\Controllers\CountiesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/counties', [CountiesController::class, 'index']);
Route::get('/counties/{id}', [CountiesController::class, 'show']);
Route::post('/counties', [CountiesController::class, 'store'])
    ->middleware('auth:sanctum');
Route::put('/counties/{id}', [CountiesController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('/counties/{id}', [CountiesController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::post('/users/login', [UsersController::class, 'login']);
Route::get('/users', [UsersController::class, 'index'])
    ->middleware('auth:sanctum');
