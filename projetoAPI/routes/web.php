<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\UserController::class, 'index']);

Route::get('/newPost', [App\Http\Controllers\UserController::class, 'newPost'])->name('posts.create');

Route::get('/posts/list', [App\Http\Controllers\UserController::class, 'posts'])->name('posts.list');

Route::get('/posts/{id}', [App\Http\Controllers\UserController::class, 'getPost']);

//salva um post
Route::post('/posts/create', [App\Http\Controllers\UserController::class, 'createPost'])->name('posts.createPost');

Route::post('/posts/list', [App\Http\Controllers\UserController::class, 'posts'])->name('posts.list');

//update
Route::get('/posts/update/{id}', [App\Http\Controllers\UserController::class, 'updatePost'])->name('posts.update');

//update
Route::put('/posts/update/', [App\Http\Controllers\UserController::class,
'updatePostSave'])->name('posts.updatePostSave');
