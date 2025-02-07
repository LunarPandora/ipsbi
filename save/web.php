<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('cors')->group(function(){
    Route::get('/post', [PostController::class, 'fetch'])->name('fetch_post');
    Route::get('/post/get', [PostController::class, 'get'])->name('get_post');
});