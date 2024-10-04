<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\StaffGAController;
use App\Http\Controllers\HeadGAController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DivisiController;
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
    Route::get('admin/divisi', [DivisiController::class,'index'])->name('admin.divisi');
    Route::get('admin/divisi/create', [DivisiController::class,'create'])->name('admin.divisi.create');
    Route::get('admin/divisi/edit', [DivisiController::class,'edit'])->name('admin.divisi.edit');
    Route::delete('admin/divisi/destroy', [DivisiController::class,'destroy'])->name('admin.divisi.destroy');
    
    //barangmasuk
    Route::get('admin/barangmasuk', [BarangMasukController::class,'index'])->name('admin.barangmasuk');
    //Route::get('admin/barangmasuk', [BarangMasukController::class,'barangkeluar'])->name('admin.barangkeluar');
    Route::get('admin/barangmasuk/create', [BarangMasukController::class,'create'])->name('admin.barangmasukcreate');
    Route::get('admin/barangmasuk/edit', [BarangMasukController::class,'edit'])->name('admin.barangmasuk.edit');
    Route::delete('admin/barangmasuk/destroy', [BarangMasukController::class,'destroy'])->name('admin.barangmasuk.destroy');
    
    //crud barang master
    Route::get('admin/barang', [BarangController::class,'index'])->name('admin.barang');
    Route::get('admin/barang/create', [BarangController::class,'create'])->name('admin.barang.create');
    Route::post('admin/barang/store', [BarangController::class,'store'])->name('admin.barang.store');
    Route::get('admin/barang/edit/{id}', [BarangController::class,'edit'])->name('admin.barang.edit');
    Route::put('admin/barang/update/{id}', [BarangController::class,'update'])->name('admin.barang.update');
    Route::delete('admin/barang/destroy/{id}', [BarangController::class,'destroy'])->name('admin.barang.destroy');

    //CRUD USER 
    //CRUD USER 
    Route::get('admin/users', [UserController::class,'index'])->name('admin.users');
    Route::get('admin/users/create', [UserController::class,'create'])->name('admin.users.create');
    Route::post('admin/users/store', [UserController::class,'store'])->name('admin.users.store');
    Route::get('admin/users/edit/{id}', [UserController::class,'edit'])->name('admin.users.edit');
    Route::put('admin/users/update/{id}', [UserController::class,'update'])->name('admin.users.update');
    Route::delete('admin/users/destroy/{id}', [UserController::class,'destroy'])->name('admin.users.destroy');

    Route::resource('admin/users', UserController::class);
    Route::resource('admin/suppliers', SupplierController::class);
    // Tambahkan route admin lainnya
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
