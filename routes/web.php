<?php

use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\A_DashboardController;
use App\Http\Controllers\A_BarangController;
use App\Http\Controllers\A_KategoriController;
use App\Http\Controllers\A_PenggunaController;
use App\Http\Controllers\A_ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\A_PesananController;

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

Route::get('/', [LandingController::class, 'index'])->name('landing');

//logout
Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});

Auth::routes();

// home
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('pesan/{id}', [PesanController::class, 'index'])->name('pesan');

// pesan barang
Route::post('pesan/{id}', [PesanController::class, 'pesan']);
//pesanan diterima
Route::post('pesan/pesanan-diterima/{id}', [PesanController::class, 'pesan_diterima']);

// Check out
Route::get('check-out', [PesanController::class, 'check_out']);
Route::get('konfirmasi', [PesanController::class, 'check_out']);
Route::delete('check-out/{id}', [PesanController::class, 'delete']);

// Konfirmasi check out
Route::post('konfirmasi-check-out', [PesanController::class, 'konfirmasi']);

// Profile
Route::get('profile', [ProfileController::class, 'index']);
// update profile
Route::post('profile', [ProfileController::class, 'update']);

// history
Route::get('history', [HistoryController::class, 'index']);
// detail history
Route::get('history/{id}', [HistoryController::class, 'detail']);



//Admin area -----------------------------------------------------------------------------

//profile
Route::get('admin/profile', [A_ProfileController::class, 'index']);
Route::post('admin/profile', [A_ProfileController::class, 'update']);

// Dashboard
Route::get('admin/dashboard', [A_DashboardController::class, 'index'])->name('adminDashboard')->middleware('isAdmin');

//Pengguna (Admin)
Route::get('admin/list-admin', [A_PenggunaController::class, 'admin'])->name('admin');;
Route::get('admin/tambah-admin', [A_PenggunaController::class, 'tambah_admin'])->name('admin');
Route::post('admin/tambah-admin', [A_PenggunaController::class, 'add_admin'])->name('admin');
Route::get('admin/list-admin/{id}', [A_PenggunaController::class, 'edit_admin'])->name('admin');
Route::post('admin/list-admin/{id}', [A_PenggunaController::class, 'update_admin']);
Route::delete('admin/list-admin/{id}', [A_PenggunaController::class, 'delete_admin']);

//Pengguna (Member)
Route::get('admin/list-member', [A_PenggunaController::class, 'member'])->name('member');
Route::delete('admin/list-member/{id}', [A_PenggunaController::class, 'delete_member']);


//Kategori
Route::get('admin/tambah-kategori', [A_KategoriController::class, 'create'])->name('kategori');
Route::post('admin/tambah-kategori', [A_KategoriController::class, 'store']);
Route::get('admin/kategori', [A_KategoriController::class, 'list'])->name('kategori');
Route::get('admin/kategori/{id}', [A_KategoriController::class, 'edit'])->name('kategori');
Route::post('admin/kategori/{id}', [A_KategoriController::class, 'update']);
Route::delete('admin/kategori/{id}', [A_KategoriController::class, 'delete']);

//Barang
Route::get('admin/tambah-barang', [A_BarangController::class, 'create'])->name('barang');
Route::post('admin/tambah-barang', [A_BarangController::class, 'store']);
Route::get('admin/barang', [A_BarangController::class, 'list'])->name('barang');
Route::get('admin/barang/{id}', [A_BarangController::class, 'edit'])->name('barang');
Route::post('admin/barang/{id}', [A_BarangController::class, 'update']);
Route::delete('admin/barang/{id}', [A_BarangController::class, 'delete']);

//Pesanan
Route::get('admin/pesanan', [A_PesananController::class, 'index'])->name('pesanan');
Route::get('admin/pesanan/{id}', [A_PesananController::class, 'detail'])->name('pesanan');
Route::post('admin/pesanan/{id}', [A_PesananController::class, 'konfirmasi']);

//Pesanan Dibayar
Route::get('admin/pesanan-dibayar', [A_PesananController::class, 'dibayar'])->name('dibayar');
Route::get('admin/pesanan-dibayar/{id}', [A_PesananController::class, 'proses_pesanan'])->name('dibayar');
Route::post('admin/pesanan-dibayar/{id}', [A_PesananController::class, 'kirim_pesanan']);

//Pesanan Dikirim
Route::get('admin/pesanan-dikirim', [A_PesananController::class, 'dikirim'])->name('dikirim');
Route::get('admin/pesanan-dikirim/{id}', [A_PesananController::class, 'detail_dikirim'])->name('dikirim');


//Pesanan Diterima
Route::get('admin/pesanan-selesai', [A_PesananController::class, 'selesai'])->name('selesai');
Route::get('admin/pesanan-selesai/{id}', [A_PesananController::class, 'detail_pesanan'])->name('selesai');

Route::get('/exportpesanan', [A_PesananController::class, 'pesananexport'])->name('exportpesanan');

Route::get('/ongkir', 'App\Http\Controllers\CheckOngkirController@index');
Route::post('/ongkir', 'App\Http\Controllers\CheckOngkirController@check_ongkir');
Route::get('/cities/{province_id}', 'App\Http\Controllers\CheckOngkirController@getCities');

Route::get('/konfirmasi', 'App\Http\Controllers\CheckOngkirController@index');