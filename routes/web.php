<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('gallery', \App\Http\Controllers\GalleryController::class);
Route::resource('/users', \App\Http\Controllers\UserController::class);
Route::resource('comments', \App\Http\Controllers\CommentController::class)->only(['store', 'update', 'destroy']);
Route::resource('contacts', \App\Http\Controllers\ContactsController::class)->only(['store', 'index']);

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
  Route::resource('/', \App\Http\Controllers\Admin\HomeController::class);
  Route::resource('/gallery', \App\Http\Controllers\Admin\GalleryController::class);
  Route::resource('/users', \App\Http\Controllers\Admin\UsersController::class);

  Route::get('/gallery/user/{userId}', [\App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery.user');
});