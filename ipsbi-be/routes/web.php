<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::post('/auth', [LoginController::class, 'login'])->name('login');

// Route::post('/login', function () {
//     return view('welcome');
// });
