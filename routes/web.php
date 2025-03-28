<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/sauces/{id}/like', [App\Http\Controllers\SauceController::class, 'like'])->name('sauces.like');
Route::post('/sauces/{id}/dislike', [App\Http\Controllers\SauceController::class, 'dislike'])->name('sauces.dislike');
Route::resource('sauces', App\Http\Controllers\SauceController::class);
