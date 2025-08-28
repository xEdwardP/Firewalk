<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

// Login
Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
// Route::post('/logear', [AuthController::class, 'logear'])->name('logear');


Route::middleware("auth")->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Categories
Route::prefix('/admin/categories')->middleware('auth')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/show{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::delete('/destroy{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Branches
Route::prefix('/admin/branches')->middleware('auth')->group(function(){
    Route::get('/', [BranchController::class, 'index'])->name('branches');
    Route::get('/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/store', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/edit{branch}', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/update{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::get('/show{branch}', [BranchController::class, 'show'])->name('branches.show');
    Route::delete('/destroy{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
});