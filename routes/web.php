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

Route::get('/sign/up', [\App\Http\Controllers\SignController::class, 'register']);
Route::get('/sign/in', [\App\Http\Controllers\SignController::class, 'login']);
//
Route::resource('gallery', \App\Http\Controllers\GalleryController::class);
Route::resource('/users', \App\Http\Controllers\UserController::class);
Route::resource('/contacts', \App\Http\Controllers\ContactsController::class, [
  'only' => ['index', 'create']
]);
Route::resource('/comments', \App\Http\Controllers\CommentController::class);
//
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
  Route::resource('/', \App\Http\Controllers\Admin\HomeController::class);
  Route::resource('/gallery', 'Controller');
  Route::resource('/users', 'Controller');
});