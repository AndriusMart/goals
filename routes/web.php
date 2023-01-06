<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController as G;
use App\Http\Controllers\HomeController as H;


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



Auth::routes();

Route::get('/', [H::class, 'homeList'])->name('home')->middleware('gate:home');
Route::post('/searchCity', [H::class, 'searchCity'])->name('searchCity')->middleware('gate:user');





Route::prefix('goal')->name('g_')->group(function () {
    Route::get('/', [G::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [G::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [G::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{goal}', [G::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{goal}', [G::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{goal}', [G::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{goal}', [G::class, 'update'])->name('update')->middleware('gate:admin');
});

