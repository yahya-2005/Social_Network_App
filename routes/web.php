<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

// Routes protégées par notre middleware custom
Route::middleware(['custom.auth'])->group(function () {
    // Routes pour les posts
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
    Route::post('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    
    // Routes pour les likes
    Route::post('/posts/{id}/like', [LikeController::class, 'like']);
});