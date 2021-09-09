<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('welcome');
});

Auth::routes();

Route::get('/auth/{service}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->where('service','github|facebook');
Route::get('/auth/{service}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
