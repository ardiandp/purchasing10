<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffGAController;
use App\Http\Controllers\HeadGAController;
use App\Http\Controllers\DivisiController;
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
    return view('welcome');
});

// Route untuk Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('admin/divisi', DivisiController::class);
    Route::resource('admin/barang', BarangController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/suppliers', SupplierController::class);
    // Tambahkan route admin lainnya
});
