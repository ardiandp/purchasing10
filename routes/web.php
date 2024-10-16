<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\StaffGAController;
use App\Http\Controllers\HeadGAController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\BarangKeluarController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RequestBarangController;
use App\Http\Controllers\Admin\MenuController;
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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  
    
   
    //stok barang 
    Route::get('admin/barang/stok', [BarangController::class,'stokbarang'])->name('admin.barang.stok');

   
    //CRUD Menu
    Route::get('master-menus', [MenuController::class,'index'])->name('master-menus');
    Route::get('admin/menus/create', [MenuController::class,'create'])->name('admin.menus.create');
    Route::post('admin/menus/store', [MenuController::class,'store'])->name('admin.menus.store');
    Route::get('admin/menus/edit/{id}', [MenuController::class,'edit'])->name('admin.menus.edit');
    Route::put('admin/menus/update/{id}', [MenuController::class,'update'])->name('admin.menus.update');
    Route::delete('admin/menus/destroy/{id}', [MenuController::class,'destroy'])->name('admin.menus.destroy');
 


     
 
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

// Route untuk Divisi
Route::middleware(['auth', 'role:Divisi'])->group(function () {
    Route::get('/homedivisi', [App\Http\Controllers\HomeController::class, 'homedivisi'])->name('homedivisi');
    Route::get('divisi/requestbarang', [RequestBarangController::class,'index'])->name('divisi.requestbarang');
});

// Route untuk Staff GA
Route::middleware(['auth', 'role:StaffGA'])->group(function () {
    Route::get('/homestaffga', [App\Http\Controllers\HomeController::class, 'homestaffga'])->name('homestaffga');
});

// Route untuk Head GA
Route::middleware(['auth', 'role:HeadGA'])->group(function () {
    Route::get('/homeheadga', [App\Http\Controllers\HomeController::class, 'homeheadga'])->name('homeheadga');
});



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// menu dibawah ini diluar hak akases atau role
    //CRUD ROLE
    Route::get('master-roles', [RoleController::class,'index'])->name('master-roles');
    Route::get('admin/roles/create', [RoleController::class,'createRole'])->name('admin.roles.create');
    Route::post('admin/roles/store', [RoleController::class,'store'])->name('admin.roles.store');
    Route::put('admin/roles/update/{id}', [RoleController::class,'update'])->name('admin.roles.update');
    Route::delete('admin/roles/destroy/{id}', [RoleController::class,'destroy'])->name('admin.roles.destroy');


    //CRUD Menu
    Route::get('master-menus', [MenuController::class,'index'])->name('admin.menu');
    Route::get('admin/menus/create', [MenuController::class,'create'])->name('admin.menus.create');
    Route::post('admin/menus/store', [MenuController::class,'store'])->name('admin.menus.store');
    Route::get('admin/menus/edit/{id}', [MenuController::class,'edit'])->name('admin.menus.edit');
    Route::put('admin/menus/update/{id}', [MenuController::class,'update'])->name('admin.menus.update');
    Route::delete('admin/menus/destroy/{id}', [MenuController::class,'destroy'])->name('admin.menus.destroy');


    //CRUD Menu Role
    Route::get('admin/menus/role', [MenuController::class,'menuRole'])->name('admin.menusrole');
    //Route::get('admin/menus/role/create', [MenuController::class,'createMenuRole'])->name('admin.menus.role.create');
    Route::post('admin/menus/role/store', [MenuController::class,'menurolestore'])->name('admin.menus.rolestore');
    //Route::get('admin/menus/role/edit/{id}', [MenuController::class,'editMenuRole'])->name('admin.menus.role.edit');
    Route::put('admin/menus/role/update/{id}', [MenuController::class,'menuroleupdate'])->name('admin.menus.roleupdate');
    Route::delete('admin/menus/role/destroy/{id}', [MenuController::class,'menuroledestroy'])->name('admin.menus.roledestroy');


    //CRUD USER 
    Route::get('master-users', [UserController::class,'index'])->name('master-users');
    Route::get('admin/users/create', [UserController::class,'create'])->name('admin.users.create');
    Route::post('admin/users/store', [UserController::class,'store'])->name('admin.users.store');
    Route::get('admin/users/edit/{id}', [UserController::class,'edit'])->name('admin.users.edit');
    Route::put('admin/users/update/{id}', [UserController::class,'update'])->name('admin.users.update');
    Route::delete('admin/users/destroy/{id}', [UserController::class,'destroy'])->name('admin.users.destroy');

     //barangmasuk
     Route::get('admin/barangmasuk', [BarangMasukController::class,'index'])->name('admin.barangmasuk');
     //Route::get('admin/barangmasuk', [BarangMasukController::class,'barangkeluar'])->name('admin.barangkeluar');
     Route::get('admin/barangmasuk/create', [BarangMasukController::class,'create'])->name('admin.barangmasukcreate');
     Route::post('admin/barangmasuk/store', [BarangMasukController::class,'store'])->name('admin.barangmasuk.store');
     Route::get('admin/barangmasuk/edit', [BarangMasukController::class,'edit'])->name('admin.barangmasuk.edit');
     Route::delete('admin/barangmasuk/destroy/{id}', [BarangMasukController::class,'destroy'])->name('admin.barangmasuk.destroy');
     
     // Barang Keluar 
     Route::get('admin/barangkeluar', [BarangKeluarController::class,'index'])->name('admin.barangkeluar');
     Route::get('admin/barangkeluar/create', [BarangkeluarController::class,'create'])->name('admin.barangkeluar.create');
     Route::post('admin/barangkeluar/store', [BarangkeluarController::class,'store'])->name('admin.barangkeluar.store');
     Route::get('admin/barangkeluar/edit', [BarangkeluarController::class,'editBarangKeluar'])->name('admin.barangkeluar.edit');
     Route::delete('admin/barangkeluar/destroy/{id}', [BarangkeluarController::class,'destroyBarangKeluar'])->name('admin.barangkeluar.destroy');
     
     //crud barang master
     Route::get('admin/barang', [BarangController::class,'index'])->name('admin.barang');
     Route::get('admin/barang/create', [BarangController::class,'create'])->name('admin.barang.create');
     Route::post('admin/barang/store', [BarangController::class,'store'])->name('admin.barang.store');
     Route::get('admin/barang/edit/{id}', [BarangController::class,'edit'])->name('admin.barang.edit');
     Route::put('admin/barang/update/{id}', [BarangController::class,'update'])->name('admin.barang.update');
     Route::delete('admin/barang/destroy/{id}', [BarangController::class,'destroy'])->name('admin.barang.destroy');

        Route::get('staffga/barang', [BarangController::class,'staffga'])->name('admin.barang');

     //master Divisi 
     Route::get('admin/divisi', [DivisiController::class,'index'])->name('admin.divisi');
     Route::post('admin/divisi/store', [DivisiController::class,'store'])->name('admin.divisi.store');
     Route::get('admin/divisi/create', [DivisiController::class,'create'])->name('admin.divisi.create');
     Route::put('admin/divisi/update/{id}', [DivisiController::class,'update'])->name('admin.divisi.update');
     Route::delete('admin/divisi/destroy/{id}', [DivisiController::class,'destroy'])->name('admin.divisi.destroy');

     //TRANSAKSI 
      // Request Barang
    Route::get('staffga/requestbarang', [RequestBarangController::class,'index'])->name('staffga.requestbarang');
    Route::get('staffga/requestbarang/create', [RequestBarangController::class,'create'])->name('staffga.requestbarang.create');
    Route::post('staffga/requestbarang/store', [RequestBarangController::class,'store'])->name('staffga.requestbarang.store');
    Route::get('staffga/requestbarang/edit/{id}', [RequestBarangController::class,'edit'])->name('staffga.requestbarang.edit');
    Route::put('staffga/requestbarang/update/{id}', [RequestBarangController::class,'update'])->name('staffga.requestbarang.update');
    Route::delete('staffga/requestbarang/destroy/{id}', [RequestBarangController::class,'destroy'])->name('staffga.requestbarang.destroy');
