<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/diary', [App\Http\Controllers\DiaryController::class, 'view'])->name('diary')->middleware('auth');

Route::post('/selloption/add', [App\Http\Controllers\DiaryController::class, 'addSale'])->name('add-sale')->middleware('auth');
Route::post('/selloption/delete', [App\Http\Controllers\DiaryController::class, 'deleteSale'])->name('delete-sale')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
