<?php

use App\Http\Controllers\AfterPaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailPesanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;

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
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('/detail-pesanan/{id}', [DetailPesanController::class, 'index'])->name('detail.pesanan');
Route::post('/detail-pesanan/{id}', [DetailPesanController::class, 'pesan'])->name('detail.pesanan');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HOMEPAGE
    Route::get('/pesanan/keranjang', [DetailPesanController::class, 'checkout'])->name('checkout');
    Route::delete('/pesanan/delete/{id}', [DetailPesanController::class, 'delete'])->name('checkout.delete');
    Route::post('confirm-checkout', [AfterPaymentController::class, 'afterPayment'])->name('confirm.checkout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // BARANG ROUTER
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/create', [BarangController::class, 'store'])->name('barang.create');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::patch('/barang/{id}/update', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}/delete', [BarangController::class, 'destroy'])->name('barang.delete');

    // PEGAWAI ROUTER
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/create', [PegawaiController::class, 'store'])->name('pegawai.create');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::patch('/pegawai/{id}/update', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}/delete', [PegawaiController::class, 'destroy'])->name('pegawai.delete');
});

require __DIR__.'/auth.php';
