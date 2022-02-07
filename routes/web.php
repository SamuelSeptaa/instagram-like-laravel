<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PostController::class, 'indexes']);

Auth::routes();

Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('home');

Route::get('/auth/google-redirect', [LoginController::class, 'redirect_provider'])->name('google-login');
Route::get('/auth/google-callback', [LoginController::class, 'callback_google']);

Route::get('/p/create', [PostController::class, 'create'])->name('post');
Route::post('/p', [PostController::class, 'store'])->name('post');

Route::get('/p/{post}', [PostController::class, 'post']);
Route::get('/p/{id}/edit', [ProfileController::class, 'edit']);

Route::patch('/profile/{user}', [ProfileController::class, 'update']);

Route::post('/follow/{id}', [FollowingController::class, 'follow']);

Route::post('/search', [FollowingController::class, 'search']);


