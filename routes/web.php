<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DataTransaksiController;

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

Route::get('/', [Home::class, 'index']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register/store', [AuthController::class, 'createRegister']);

Route::post('/sign', [AuthController::class, 'CekLogin']);
Route::get("/logout", [AuthController::class, "logout"]);
Route::get('/home', [Home::class, 'index']);
Route::get('/detail_product/{id}', [Home::class, 'detail_product']);

Route::middleware('auth')->group(function () {
   Route::get('/customer/data_keranjang', [Home::class, 'cart']);
   Route::post('/add_cart/{id}', [Home::class, 'add_cart']);
   Route::get('/drop_cart/{id}', [Home::class, 'drop_cart']);
   Route::post('/checkout', [TransaksiController::class, 'checkout']);
   Route::get('/customer/transaksi', [TransaksiController::class, 'transaksi']);
   Route::get('/customer/detail_transaksi/{id}', [TransaksiController::class, 'detail_transaksi']);
   Route::put('/customer/update/{id}', [TransaksiController::class, 'update']);
   Route::get('customer/histori_transaksi', [TransaksiController::class, 'histori_transaksi'])->name('customer.histori_transaksi');
   Route::get('/edit_profile/{id}', [Home::class, 'edit_profile']);
   Route::put('/update_profile/{id}', [Home::class, 'update_profile']);
   //Owner
   Route::get('/dashboard', [OwnerController::class, 'dashboard']);
   Route::get('/data_product/create', [ProductController::class, 'create']);
   Route::get('/data_product/{id}', [ImageController::class, 'destroy']);
   Route::resource('/data_product', ProductController::class);
   Route::resource('/kategori_product', KategoriController::class);
   Route::resource('/customer', CustomerController::class);
   Route::get('/data_transaksi', [DataTransaksiController::class, 'index']);
   Route::get('/detail_transaksi/{id}', [TransaksiController::class, 'detail_transaksi']);
   Route::post('/proses_transaksi/{id}', [TransaksiController::class, 'proses_transaksi']);
});
