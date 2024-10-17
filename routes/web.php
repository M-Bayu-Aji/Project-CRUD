<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KaryawanController;

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::prefix('/product')->name('product.')->group(function () {
    Route::get('/list-product', [ProductController::class, 'index'])->name('product_page'); 
    Route::get('/add-product', [ProductController::class, 'create'])->name('add_product');
    Route::post('/add-product/proses', [ProductController::class, 'store'])->name('add_product_page');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit_product');
    Route::patch('/edit-product/proses/{id}', [ProductController::class, 'update'])->name('edit_product_proses');
    Route::delete('/hapus-product/{id}', [ProductController::class, 'destroy'])->name('hapus_product');
});

Route::prefix('/karyawan')->name('karyawan.')->group(function () {
    Route::get('list-karyawan', [KaryawanController::class, 'index'])->name('karyawan_page');
    Route::get('/add-karyawan', [KaryawanController::class, 'create'])->name('add_karyawan');
    Route::post('/add-karyawan-page', [KaryawanController::class, 'store'])->name('add_karyawan_page');
    Route::get('/edit-karyawan/{id}', [KaryawanController::class, 'edit'])->name('edit_karyawan_page');
    Route::patch('/update-karyawan/{id}', [KaryawanController::class, 'update'])->name('edit_karyawan_proses');
    Route::delete('/delete-karyawan/{id}', [KaryawanController::class, 'destroy'])->name('delete_karyawan');
});