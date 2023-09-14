<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('post')->group(function (){
   Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'posts']);
   Route::get('/categories', [\App\Http\Controllers\Api\PostController::class, 'categories']);
   Route::post('/post-search', [\App\Http\Controllers\Api\PostController::class, 'searchPost']);
   Route::post('/category-search', [\App\Http\Controllers\Api\PostController::class, 'searchCategory']);
});