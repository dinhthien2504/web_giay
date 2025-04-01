<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User; 

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// require __DIR__.'/auth.php';

Route::post('/register', [User::class, 'register']);