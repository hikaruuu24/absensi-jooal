<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LaporanAktifitasController;
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
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');

Route::middleware('auth:web')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');

    Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    
    Route::get('laporan-aktifitas', [LaporanAktifitasController::class, 'index'])->name('laporan-aktifitas.index');
    Route::post('laporan-aktifitas', [LaporanAktifitasController::class, 'store'])->name('laporan-aktifitas.store');
    Route::delete('laporan-aktifitas/{id}', [LaporanAktifitasController::class, 'destroy'])->name('laporan-aktifitas.destroy');
    Route::patch('laporan-aktifitas/{id}', [LaporanAktifitasController::class, 'update'])->name('laporan-aktifitas.update');

    // Master Data
     Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    // Departement
    Route::resource('departements', DepartementController::class);

    // Users
    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::resource('users', UserController::class)->except([
        'show'
    ]);;
    
    // History Log
    Route::resource('history-log', HistoryLogController::class)->except([
        'show', 'create', 'store', 'edit', 'update'
    ]);;

});