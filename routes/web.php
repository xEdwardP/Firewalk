<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

// Categories
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth');
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');