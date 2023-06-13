<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;

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
    // Bayar Kos
    Route::get('tagihan', [UserController::class, 'showTagihan'])->name('tagihan'); 
    Route::post('storeTagihan', [UserController::class, 'storeTagihan'])->name('storeTagihan'); 

    
});


/*
* 
* Pengurus Routes
* 
 */

Route::group(['prefix' => 'pengurus', 'middleware' => ['auth', 'akses:Pengurus'], 'as' => 'pengurus/'], function(){

    Route::get('dashboard', [PengurusController::class, 'index'])->name('dashboard');
    // Pendaftaran
    Route::get('verifikasi', [PengurusController::class, 'showVerifikasi'])->name('verifikasi');
    Route::get('updateVerifikasi/{id}', [PengurusController::class, 'updateVerifikasi'])->name('updateVerifikasi/');
    Route::get('tolakVerifikasi/{id}', [PengurusController::class, 'tolakVerifikasi'])->name('tolakVerifikasi/');
    // Pembayaran
    Route::get('pembayaran', [PengurusController::class, 'showPembayaran'])->name('pembayaran');
    Route::get('tolakPembayaran/{id}', [PengurusController::class, 'tolakPembayaran'])->name('tolakPembayaran/');
    Route::get('accPembayaran/{id}', [PengurusController::class, 'accPembayaran'])->name('accPembayaran/');
}); 


 /*
 * 
 * Pemilik Routes
 * 
 */

Route::group(['prefix' => 'pemilik', 'middleware' => ['auth', 'akses:Pemilik'], 'as' => 'pemilik/'], function(){

    Route::get('dashboard', [PemilikController::class, 'index'])->name('dashboard');
    // Kos
    Route::get('kos', [PemilikController::class, 'showKos'])->name('kos');
    Route::post('storeKos', [PemilikController::class, 'storeKos'])->name('storeKos');
    Route::get('detail-kos/{id}', [PemilikController::class, 'detailKos'])->name('detail-kos/');
    Route::post('update-kos/{id}', [PemilikController::class, 'updateKos'])->name('update-kos/');
    Route::post('update-fotoKos/{id}', [PemilikController::class, 'updateFotoKos'])->name('update-fotoKos/');
    // Pendaftaran
    Route::get('verifikasi', [PemilikController::class, 'showVerifikasi'])->name('verifikasi');
    Route::get('updateVerifikasi/{id}', [PemilikController::class, 'updateVerifikasi'])->name('updateVerifikasi/');
    Route::get('tolakVerifikasi/{id}', [PemilikController::class, 'tolakVerifikasi'])->name('tolakVerifikasi/');
    // Pembayaran
    Route::get('pembayaran', [PemilikController::class, 'showPembayaran'])->name('pembayaran');
    Route::get('tolakPembayaran/{id}', [PemilikController::class, 'tolakPembayaran'])->name('tolakPembayaran/');
    Route::get('accPembayaran/{id}', [PemilikController::class, 'accPembayaran'])->name('accPembayaran/');
}); 









Route::view('403', 'errors.403');