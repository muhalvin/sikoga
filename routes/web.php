<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Artisan;

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

/**
 * 
 * Setting Route
 * 
 */

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return 'The links have been created.';
});

/*
 *
 *  Register Route 
 * 
 */

Route::middleware(['guest'])->group(function () {
    Route::post('prosesRegister', [RegisterController::class, 'create'])->name('prosesRegister');
    Route::get('register', [RegisterController::class, 'index'])->name('register');
});

/*
* 
* Login Routes
* 
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('prosesLogin', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');


/*
 * 
 * User Routes
 * 
 */

Route::middleware(['auth', 'akses:Anak Kos'])->group(function () {

    // Dashboard 
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('showKos/{id}', [UserController::class, 'showKos'])->name('showKos/');
    // Profil
    Route::get('profile', [UserController::class, 'showProfile'])->name('profile');
    Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('updateFoto', [UserController::class, 'updateFoto'])->name('updateFoto');
    // Pendaftaran 
    Route::get('verifikasi', [UserController::class, 'showVerifikasi'])->name('verifikasi');
    Route::post('createVerifikasi', [UserController::class, 'createVerifikasi'])->name('createVerifikasi');
    Route::post('updateVerifikasi/{id}', [UserController::class, 'updateVerifikasi'])->name('updateVerifikasi/');
    // Pembayaran
    Route::get('pembayaran', [UserController::class, 'showPembayaran'])->name('pembayaran');
    Route::post('storePembayaran', [UserController::class, 'storePembayaran'])->name('storePembayaran');
    Route::post('storePembayaranBulanan', [UserController::class, 'storePembayaranBulanan'])->name('storePembayaranBulanan');
    Route::get('nota', [UserController::class, 'showNota'])->name('nota');
    // Bayar Kos
    Route::get('tagihan', [UserController::class, 'showTagihan'])->name('tagihan');
    Route::post('storeTagihan', [UserController::class, 'storeTagihan'])->name('storeTagihan');
    Route::get('invoice/{id}', [UserController::class, 'showInvoice'])->name('invoice/');
});


/*
* 
* Pengurus Routes
* 
 */

Route::group(['prefix' => 'pengurus', 'middleware' => ['auth', 'akses:Pengurus'], 'as' => 'pengurus/'], function () {

    Route::get('dashboard', [PengurusController::class, 'index'])->name('dashboard');
    // Pendaftaran
    Route::get('verifikasi', [PengurusController::class, 'showVerifikasi'])->name('verifikasi');
    Route::get('updateVerifikasi/{id}', [PengurusController::class, 'updateVerifikasi'])->name('updateVerifikasi/');
    Route::get('tolakVerifikasi/{id}', [PengurusController::class, 'tolakVerifikasi'])->name('tolakVerifikasi/');
    Route::get('deleteVerifikasi/{id}', [PengurusController::class, 'deleteVerifikasi'])->name('deleteVerifikasi/');
    // Pembayaran
    Route::get('pembayaran', [PengurusController::class, 'showPembayaran'])->name('pembayaran');
    Route::get('tolakPembayaran/{id}', [PengurusController::class, 'tolakPembayaran'])->name('tolakPembayaran/');
    Route::get('accPembayaran/{id}', [PengurusController::class, 'accPembayaran'])->name('accPembayaran/');
    // Notifikasi
    Route::get('getNotify', [PengurusController::class, 'showNotify'])->name('getNotify');
    Route::get('getPaymentNotify', [PengurusController::class, 'showPaymentNotify'])->name('getPaymentNotify');
});


/*
 * 
 * Pemilik Routes
 * 
 */

Route::group(['prefix' => 'pemilik', 'middleware' => ['auth', 'akses:Pemilik'], 'as' => 'pemilik/'], function () {

    Route::get('dashboard', [PemilikController::class, 'index'])->name('dashboard');
    // Kos
    Route::get('kos', [PemilikController::class, 'showKos'])->name('kos');
    Route::post('storeKos', [PemilikController::class, 'storeKos'])->name('storeKos');
    Route::get('detail-kos/{id}', [PemilikController::class, 'detailKos'])->name('detail-kos/');
    Route::post('update-kos/{id}', [PemilikController::class, 'updateKos'])->name('update-kos/');
    Route::post('update-fotoKos/{id}', [PemilikController::class, 'updateFotoKos'])->name('update-fotoKos/');

    Route::get('users', [PemilikController::class, 'showUsers'])->name('users');
    // Pendaftaran
    Route::get('verifikasi', [PemilikController::class, 'showVerifikasi'])->name('verifikasi');
    Route::get('updateVerifikasi/{id}', [PemilikController::class, 'updateVerifikasi'])->name('updateVerifikasi/');
    Route::get('tolakVerifikasi/{id}', [PemilikController::class, 'tolakVerifikasi'])->name('tolakVerifikasi/');
    Route::get('deleteVerifikasi/{id}', [PemilikController::class, 'deleteVerifikasi'])->name('deleteVerifikasi/');
    // Pembayaran
    Route::get('pembayaran', [PemilikController::class, 'showPembayaran'])->name('pembayaran');
    Route::get('tolakPembayaran/{id}', [PemilikController::class, 'tolakPembayaran'])->name('tolakPembayaran/');
    Route::get('accPembayaran/{id}', [PemilikController::class, 'accPembayaran'])->name('accPembayaran/');
    // Tagihan
    Route::get('tagihan', [PemilikController::class, 'showTagihan'])->name('tagihan');
    Route::get('tolakTagihan/{id}', [PemilikController::class, 'tolakTagihan'])->name('tolakTagihan/');
    Route::get('accTagihan/{id}', [PemilikController::class, 'accTagihan'])->name('accTagihan/');
    // Notifikasi
    Route::get('getNotify', [PemilikController::class, 'showNotify'])->name('getNotify');
    Route::get('getPaymentNotify', [PemilikController::class, 'showPaymentNotify'])->name('getPaymentNotify');
    Route::get('getTagihanNotif', [PemilikController::class, 'showTagihanNotif'])->name('getTagihanNotif');
});









Route::view('403', 'errors.403');
