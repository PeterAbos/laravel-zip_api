<?php

use App\Http\Controllers\CountiesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/counties', [CountiesController::class, 'index']);
Route::get('/counties/{id}', [CountiesController::class, 'show']);

Route::post('/users/login', [UsersController::class, 'login']);
Route::get('/users', [UsersController::class, 'index'])
    ->middleware('auth:sanctum');
