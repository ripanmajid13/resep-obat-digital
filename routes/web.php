<?php

use App\Http\Controllers\ResepController;
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

Route::group(['middleware' => 'prevent.back.history'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => '', 'as' => 'resep.'], function () {
            Route::get('', [ResepController::class, 'index'])->name('index');
            Route::get('/create', [ResepController::class, 'create'])->name('create');

            Route::post('/store', [ResepController::class, 'store'])->name('store');
            Route::post('/tambah-obat-non-racikan', [ResepController::class, 'tambahObatNonRacikan'])->name('tambah.obat.non.racikan');
            Route::post('/tambah-obat-racikan', [ResepController::class, 'tambahObatRacikan'])->name('tambah.obat.racikan');
        });
    });

    require __DIR__.'/auth.php';
});
