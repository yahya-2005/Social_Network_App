<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showR']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showL'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);