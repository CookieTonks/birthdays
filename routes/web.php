<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/add/', [App\Http\Controllers\HomeController::class, 'add'])->name('add')->middleware('auth');
Route::post('/edit/', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit')->middleware('auth');
Route::post('/delete/', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete')->middleware('auth');
