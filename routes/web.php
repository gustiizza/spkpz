<?php

use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubKriteriaController;

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
    return view('auth.login');
});

// Route::get('/', function () {

//     return view('/pengguna');
// })->middleware(['auth', 'verified'])->name('pengguna.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Define resource routes here
    Route::resource('/pengguna', UserController::class);
    Route::resource('/kriteria', KriteriaController::class);
    Route::resource('/subkriteria', SubKriteriaController::class);
});

require __DIR__.'/auth.php';
