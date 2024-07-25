<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Permission Routes
    Route::get('/permissions/', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions/', [PermissionController::class, 'destroy'])->name('permission.destroy');

    //Role routes
    Route::get('/roles/', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/roles/', [RoleController::class, 'destroy'])->name('role.destroy');

    //User routes
    Route::get('/users/', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/', [UserController::class, 'destroy'])->name('user.destroy');

    //Article  routes
    Route::get('/articles/', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/articles/{id}/update', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/articles/', [ArticleController::class, 'destroy'])->name('article.destroy');
});

require __DIR__ . '/auth.php';
