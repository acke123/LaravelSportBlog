<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;


Route::view('/about-us', 'aboutUs')->middleware('auth')->name('aboutUs');

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::view('/createPost', 'posts.createPostView')->name('createPostView');
    Route::post('/createPost', [PostController::class, 'createPost'])->name('createPost');
});


Route::middleware(AdminCheckMiddleware::class)->group(function () {
    Route::get('/categoryView', [CategoryController::class, 'getAllCategory'])->name('categoryView');
    Route::view('/createCategory', 'category.createCategory')->name('createCategoryView');
    Route::post('/createCategory', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::get('/editCategory/{category}', [CategoryController::class, 'getCategoryById'])->name('editCategoryView');
    Route::put('/editCategory/{category}', [CategoryController::class, 'editCategory'])->name('editCategory');
    Route::delete('/deleteCategory/{category}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});

Route::middleware(AdminCheckMiddleware::class)->group(function () {
    Route::get('/usersView', [UserController::class, 'getAllUsers'])->name('usersView');
    Route::get('/editUser/{user}', [UserController::class, 'getUser'])->name('editUserView');
    Route::put('/editUser/{user}', [UserController::class, 'editUser'])->name('editUser');
    Route::delete('deleteUser/{user}', [UserController::class, 'deleteUser'])->name('deleteUser');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
