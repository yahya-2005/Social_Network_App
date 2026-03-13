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

Route::middleware(['custom.auth'])->group(function () {
    

Route::get('/posts', [PostController::class, 'index']);
   
Route::get('/posts/create', [PostController::class, 'create']);
   
Route::post('/posts', [PostController::class, 'store']);
    
Route::get('/posts/{id}', [PostController::class, 'show']);
   
    Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
   
    Route::post('/posts/{id}', [PostController::class, 'update']);
    
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    
    
    Route::post('/posts/{id}/like', [LikeController::class, 'like']);

});