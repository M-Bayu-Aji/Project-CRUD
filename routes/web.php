<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RegisterController;

Route::middleware(['IsLogout'])->group(function () {
    Route::get('/', function () {
        return view('login.index', [
            'title' => 'Login'
        ]);
    })->name('login');
    Route::get('/login/proses', [LoginController::class, 'index'])->name('login.proses')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/welcome', function () {
        return view('pages.welcome', [
            'title' => 'Welcome'
        ]);
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

    Route::prefix('/payment')->name('payment.')->group(function () {
        Route::get('/payment-page', [PaymentController::class, 'index'])->name('payment_page');
        Route::get('/add-payment/{id}', [PaymentController::class, 'addPayment'])->name('add_payment');
        Route::get('/add-payment-page', [PaymentController::class, 'show'])->name('add_payment_page');
        Route::post('/add-payment-page/cart', [PaymentController::class, 'store'])->name('add_payment_page_cart');
        Route::delete('/delete-payment/{id}', [PaymentController::class, 'destroy'])->name('delete_payment');
    });
});

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register-proses', [RegisterController::class, 'store'])->name('register')->middleware('guest');
Route::delete('/delete-account/{id}', [RegisterController::class, 'deleteAccount'])->name('delete_akun');
