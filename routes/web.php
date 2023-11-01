<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\LihatPenerimaController;

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

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('auth:guest');

Route::get('/', function () {
    return view('auth.login');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {
    // Operator
    Route::resource('/pengguna', UserController::class)->middleware('pengguna');
    Route::resource('/kriteria', KriteriaController::class)->middleware('kriteria');
    Route::resource('/subkriteria', SubKriteriaController::class)->middleware('subkriteria');
    //DM
    Route::resource('/bobot', BobotController::class)->middleware('bobot');
    Route::resource('/lihat', LihatPenerimaController::class)
    ->middleware('penerima')
    ->only([
        'index', 'show'
    ])
    ->names([
        'index' => 'penerima.lihat',
    ]);


    // Relawan Zakat
    Route::resource('/penerima', PenerimaController::class)->middleware('penerima');
});

require __DIR__.'/auth.php';
