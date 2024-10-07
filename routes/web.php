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
use App\Http\Controllers\Admin\RoleController;
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
    Route::post('admin/divisi/store', [DivisiController::class,'store'])->name('admin.divisi.store');
    Route::get('admin/divisi/create', [DivisiController::class,'create'])->name('admin.divisi.create');
    Route::get('admin/divisi/edit', [DivisiController::class,'edit'])->name('admin.divisi.edit');
    Route::delete('admin/divisi/destroy/{id}', [DivisiController::class,'destroy'])->name('admin.divisi.destroy');
    
    //barangmasuk
    Route::get('admin/barangmasuk', [BarangMasukController::class,'index'])->name('admin.barangmasuk');
    //Route::get('admin/barangmasuk', [BarangMasukController::class,'barangkeluar'])->name('admin.barangkeluar');
    Route::get('admin/barangmasuk/create', [BarangMasukController::class,'create'])->name('admin.barangmasukcreate');
    Route::post('admin/barangmasuk/store', [BarangMasukController::class,'store'])->name('admin.barangmasuk.store');
    Route::get('admin/barangmasuk/edit', [BarangMasukController::class,'edit'])->name('admin.barangmasuk.edit');
    Route::delete('admin/barangmasuk/destroy/{id}', [BarangMasukController::class,'destroy'])->name('admin.barangmasuk.destroy');
    
    //crud barang master
    Route::get('admin/barang', [BarangController::class,'index'])->name('admin.barang');
    Route::get('admin/barang/create', [BarangController::class,'create'])->name('admin.barang.create');
    Route::post('admin/barang/store', [BarangController::class,'store'])->name('admin.barang.store');
    Route::get('admin/barang/edit/{id}', [BarangController::class,'edit'])->name('admin.barang.edit');
    Route::put('admin/barang/update/{id}', [BarangController::class,'update'])->name('admin.barang.update');
    Route::delete('admin/barang/destroy/{id}', [BarangController::class,'destroy'])->name('admin.barang.destroy');

 
    //CRUD USER 
    Route::get('master-users', [UserController::class,'index'])->name('master-users');
    Route::get('admin/users/create', [UserController::class,'create'])->name('admin.users.create');
    Route::post('admin/users/store', [UserController::class,'store'])->name('admin.users.store');
    Route::get('admin/users/edit/{id}', [UserController::class,'edit'])->name('admin.users.edit');
    Route::put('admin/users/update/{id}', [UserController::class,'update'])->name('admin.users.update');
    Route::delete('admin/users/destroy/{id}', [UserController::class,'destroy'])->name('admin.users.destroy');

     //CRUD ROLE
    Route::get('master-roles', [RoleController::class,'index'])->name('master-roles');
    Route::get('admin/roles/create', [RoleController::class,'createRole'])->name('admin.roles.create');
    Route::post('admin/roles/store', [RoleController::class,'storeRole'])->name('admin.roles.store');
    Route::get('admin/roles/edit/{id}', [RoleController::class,'editRole'])->name('admin.roles.edit');
    Route::put('admin/roles/update/{id}', [RoleController::class,'updateRole'])->name('admin.roles.update');
    Route::delete('admin/roles/destroy/{id}', [RoleController::class,'destroyRole'])->name('admin.roles.destroy');
    
 
    //CRUD Supplier
    Route::get('suppliers', [SupplierController::class,'index'])->name('suppliers');
    Route::get('admin/suppliers/create', [SupplierController::class,'create'])->name('admin.suppliers.create');
    Route::post('admin/suppliers/store', [SupplierController::class,'store'])->name('admin.suppliers.store');
    Route::get('admin/suppliers/edit/{id}', [SupplierController::class,'edit'])->name('admin.suppliers.edit');
    Route::put('admin/suppliers/update/{id}', [SupplierController::class,'update'])->name('admin.suppliers.update');
    Route::delete('admin/suppliers/destroy/{id}', [SupplierController::class,'destroy'])->name('admin.suppliers.destroy');
    

    Route::resource('admin/users', UserController::class);
    Route::resource('admin/suppliers', SupplierController::class);
    // Tambahkan route admin lainnya
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
