<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class,'index']);
Route::post('save_post',[PostController::class,'save_post']);
Route::get('get_posts',[PostController::class,'get_posts']);
Route::get('edit/{id}',[PostController::class,'edit']);
Route::post('edit/update_post/{id}',[PostController::class,'update']);

Route::post('del_post/{id}',[PostController::class,'destroy']);

Route::get('add/to/cart/{id}',[CartController::class,'addCart']);

Route::get('check',[CartController::class,'check']);


