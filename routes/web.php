<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\LihatPenerimaController;
use App\Http\Controllers\PerhitunganController;
use App\Models\Hasil;

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

Route::middleware('auth')->group(function () {
    // Operator
    Route::resource('/pengguna', UserController::class)->middleware('pengguna');
    Route::resource('/kriteria', KriteriaController::class)->middleware('kriteria');
    Route::resource('/subkriteria', SubKriteriaController::class)->middleware('subkriteria');

    //DM
    Route::resource('/bobot', BobotController::class)->middleware('bobot');
    Route::resource('/lihat', LihatPenerimaController::class)
        ->middleware('lihatpenerima')
        ->only([
            'index', 'show'
        ])
        ->names([
            'index' => 'penerima.lihat',
        ]);
    Route::resource('/perhitungan', PerhitunganController::class)
    ->middleware('perhitungan')
    ->only([
        'index', 'show'
    ])
    ->names([
        'index' => 'perhitungan.index',
    ]);

    // Relawan Zakat
    Route::resource('/penerima', PenerimaController::class)->middleware('penerima');
    //Semua
    Route::resource('/hasil', HasilController::class)
    ->middleware('hasil')
    ->only(['index', 'cetak']) // Change 'cetak' to 'show'
    ->names([
        'index' => 'perhitungan.hasil', 'cetak' => 'perhitungan.cetak', // Change 'cetak' to 'show'
    ]);
    Route::get('/hasil/cetak', [HasilController::class, 'cetak'])->middleware('hasil')->name('perhitungan.cetak');
});

require __DIR__ . '/auth.php';
