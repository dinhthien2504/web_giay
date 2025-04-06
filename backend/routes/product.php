<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index'])->name('product.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('products', [ProductController::class, 'store'])->name('product.store');
Route::patch('products/{id}', [ProductController::class, 'update'])->name('product.update');
