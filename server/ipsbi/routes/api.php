<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FormController;

// Route::get('/user', funciton (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/banner', [BannerController::class, 'fetch'])->name('fetch_banner');
Route::get('/cat', [CategoryController::class, 'fetch'])->name('fetch_category');
Route::get('/form', [FormController::class, 'fetch'])->name('fetch_form');

Route::prefix('post')->group(function (){
    Route::get('/', [PostController::class, 'fetch'])->name('fetch_post');
    Route::get('/get', [PostController::class, 'get'])->name('get_post');
    Route::get('/getpage', [PostController::class, 'getPage'])->name('getpage_post');
});

Route::prefix('com')->group(function (){
    Route::get('/', [CommentController::class, 'fetch'])->name('fetch_comment');
    Route::get('/search', [CommentController::class, 'search'])->name('search_comment');
    Route::get('/get', [CommentController::class, 'get'])->name('get_comment');
    Route::post('/add', [CommentController::class, 'create'])->name('add_comment');
});

// Route::middleware(['role:admin'])->group(function (){
    Route::get('/user', [UserController::class, 'fetch'])->name('fetch_user');
    
    Route::prefix('post')->group(function (){
        Route::post('/add', [PostController::class, 'create'])->name('create_post');
        Route::post('/update', [PostController::class, 'update'])->name('update_post');
        Route::post('/delete', [PostController::class, 'delete'])->name('delete_post');
    });

    Route::prefix('banner')->group(function (){
        Route::post('/add', [BannerController::class, 'create'])->name('create_banner');
        Route::post('/delete', [BannerController::class, 'delete'])->name('delete_banner');
    });

    Route::prefix('acc')->group(function (){
        Route::post('/add', [UserController::class, 'create'])->name('create_acc');
        Route::post('/update', [UserController::class, 'update'])->name('update_acc');
        Route::post('/delete', [UserController::class, 'delete'])->name('delete_acc');
    });

    Route::prefix('form')->group(function (){
        Route::post('/add', [FormController::class, 'create'])->name('create_fr');
        Route::post('/update', [FormController::class, 'update'])->name('update_fr');
        Route::post('/delete', [FormController::class, 'delete'])->name('delete_fr');
    });

    Route::get('/com/delete', [CommentController::class, 'delete'])->name('rem_comment');
// });