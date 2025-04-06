<?php
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('categories', [CategoryController::class, 'store'])->name('category.store');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

