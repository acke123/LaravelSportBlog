<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('home');

Route::view('/about-us', 'aboutUs')->middleware('auth')->name('aboutUs');


Route::middleware(AdminCheckMiddleware::class)->group(function () {
    Route::get('/categoryView', [CategoryController::class, 'getAllCategory'])->name('categoryView');
    Route::view('/createCategory', 'category.createCategory')->name('createCategoryView');
    Route::post('/createCategory', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::get('/editCategory/{category}', [CategoryController::class, 'getCategoryById'])->name('editCategoryView');
    Route::put('/editCategory/{category}', [CategoryController::class, 'editCategory'])->name('editCategory');
    Route::delete('/deleteCategory/{category}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
