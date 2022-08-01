<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UrlController;


/*

*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication routes
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profile', [AuthController::class, 'userProfile'])->name('profile');
Route::post('update', [AuthController::class, 'updateUserProfile'])->name('user.edit');
Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('user.resetpassword');



// Url routes
Route::get('list', [UrlController::class, 'index'])->name('list');
Route::post('create_url', [UrlController::class, 'store'])->name('create_url');

Route::get('{short_url}', [UrlController::class, 'deleteShortenLink'])->name('shorten.link.delete');
Route::get('edit_url/{url_id}', [UrlController::class, 'editShortenLink'])->name('shorten.link.edit');
Route::get('disable/{url_id}', [UrlController::class, 'disableShortenLink'])->name('shorten.link.disable');

Route::post('edit_url/{url_id}', [UrlController::class, 'editLink'])->name('link.edit');





