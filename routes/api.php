<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthController;

// 1. Route Publik (Register & Login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 2. Akses Read All & Show (Tanpa Autentikasi)
Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);

// 3. Akses Terproteksi (Harus Login)
Route::middleware('auth:api')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    // 4. Khusus Role Admin (Create, Update, Destroy)
    Route::middleware('roll:admin')->group(function () {
        Route::apiResource('books', BookController::class)->except(['index', 'show']);
        Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);
        Route::apiResource('genres', GenreController::class)->except(['index', 'show']);
    });
});