<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
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

Route::get('/', function () {
    return redirect('/users');
});

Auth::routes();

Route::resource('users', UserController::class);
Route::post('/todos/add', [TodoController::class, 'add']);
Route::get('/todos/delete/{id}', [TodoController::class, 'delete']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/uploadImage', [App\Http\Controllers\HomeController::class, 'uploadImage']);

Route::get('/profileimg/{id}', [App\Http\Controllers\ProfilePictureManagerController::class, 'index'])->name('profileimg');
Route::post('/profileimg/uploadImage/{id}', [App\Http\Controllers\ProfilePictureManagerController::class, 'uploadImage']);