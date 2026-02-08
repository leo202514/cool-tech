<?php

use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page showing the latest 5 articles
Route::get('/', [HomeController::class, 'index']);

// Paginated archive of all articles
Route::get('/articles', [ArticleController::class, 'all']);

// Search interface (Keywords, ID, and Dropdowns)
Route::get('/search', [ArticleController::class, 'index']);

// Individual article view
Route::get('/article/{id}', [ArticleController::class, 'show']);

// Categorized/Tagged lists
Route::get('/category/{slug}', [ArticleController::class, 'byCategory']);
Route::get('/tag/{slug}', [ArticleController::class, 'byTag']);

// Static Legal/Privacy info
Route::view('/legal', 'legal');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Protected Consoles (Role-Based Access Control)
|--------------------------------------------------------------------------
*/

// WRITER CONSOLE: Access restricted to Writers and Admins
Route::middleware(['auth', App\Http\Middleware\AuthorAuth::class])->group(function () {
    Route::get('/writer', [WriterController::class, 'index']);
    Route::post('/writer', [WriterController::class, 'store']);
});

// ADMIN CONSOLE: High-level site and user management
Route::middleware(['auth', App\Http\Middleware\AdminAuth::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::patch('/admin/update-profile', [AdminController::class, 'updateAdmin']);

    // User Management Console
    Route::get('/user-admin', [UserAdminController::class, 'index']);
    Route::patch('/user-admin/{user}/role', [UserAdminController::class, 'updateRole']);
    Route::delete('/user-admin/{user}', [UserAdminController::class, 'destroy']);

    // Content Management (Category & Article cleanup)
    Route::patch('/admin/category/{id}', [AdminController::class, 'updateCategory']);
    Route::delete('/admin/article/{id}', [AdminController::class, 'destroyArticle']);
});
