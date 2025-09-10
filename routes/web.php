<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryBranchBatchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware("auth")->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');
});

// Categories
Route::prefix('/admin/categories')->middleware('auth')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/show{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::delete('/destroy{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Branches
Route::prefix('/admin/branches')->middleware('auth')->group(function () {
    Route::get('/', [BranchController::class, 'index'])->name('branches');
    Route::get('/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/store', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/edit{branch}', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/update{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::get('/show{branch}', [BranchController::class, 'show'])->name('branches.show');
    Route::delete('/destroy{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
});

// Products
Route::prefix('/admin/products')->middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/update{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/show{product}', [ProductController::class, 'show'])->name('products.show');
    Route::delete('/destroy{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Suppliers
Route::prefix('/admin/suppliers')->middleware('auth')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('suppliers');
    Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::put('/update{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/destroy{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

// Purchases
Route::prefix('/admin/purchases')->middleware('auth')->group(function () {
    Route::get('/', [PurchaseController::class, 'index'])->name('purchases');
    Route::get('/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/store', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/edit{purchase}', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::get('/send-email{purchase}', [PurchaseController::class, 'sendEmail'])->name('purchases.sendEmail');
    Route::post('/complete-purchase{purchase}', [PurchaseController::class, 'completePurchase'])->name('purchases.completePurchase');
    Route::put('/update{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::get('/show{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::delete('/destroy{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
});

// Batches
Route::prefix('/admin/inventory/batches')->middleware('auth')->group(function () {
    Route::get('/', [BatchController::class, 'index'])->name('batches');
});

// Branches in Batches
Route::prefix('/admin/inventory/branches_in_batches')->middleware('auth')->group(function () {
    Route::get('/', [InventoryBranchBatchController::class, 'index'])->name('branches_in_batches');
    Route::get('/inventory_in_branch/branch/{branch}', [InventoryBranchBatchController::class, 'showInventoryInBranch'])->name('inventory_in_branch');
});
