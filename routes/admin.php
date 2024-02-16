<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('admin.home');

// 7 metodos de crud con un solor codigo
Route::resource('categories', CategoryController::class)->names('admin.categories');
Route::resource('tags', TagController::class )->names('admin.tags');
Route::resource('posts', PostController::class )->names('admin.posts');