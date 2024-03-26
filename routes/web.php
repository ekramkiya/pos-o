<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ProductBuyController;

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('permission:home view');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index')->middleware('permission:setting view');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store')->middleware('permission:setting update');
    Route::resource('products', ProductController::class)->middleware('permission:product view');
    Route::get('products/{product}/print', [ProductController::class,'print'])->name('products.print');
    Route::get('/shortage',[ProductController::class,'shortage'])->name('product.shortage');
    Route::resource('customers', CustomerController::class)->middleware('permission:customer view');
    Route::get('employe', [UserController::class, 'index'])->name('employe.index')->middleware('permission:employe view ');
    Route::get('employe/create', [UserController::class, 'create'])->name('employe.create')->middleware('permission:employe create ');
    Route::put('employe/store', [UserController::class, 'store'])->name('employe.store');
    Route::get('employe/edit/{user}', [UserController::class, 'edit'])->name('employe.edit')->middleware('permission:employe update ');
    Route::put('employe/update/{user}', [UserController::class, 'update'])->name('employe.update');
    Route::delete('employe/destroy/{user}', [UserController::class, 'destroy'])->name('employe.destroy')->middleware('permission:employe delete ');
    Route::resource('orders', OrderController::class)->middleware('permission:order view');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('permission:cart view ');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);
    Route::get('/print', [CartController::class, 'print'])->name('print');
    Route::resource('/role', RoleController::class)->middleware('permission:role view ');
    Route::get('/update', [RoleController::class, 'toupdate'])->name('toupdate');
    Route::resource('expenses', ExpensesController::class)->middleware('permission:expenses view');
    Route::resource('/purchase',ProductBuyController::class);

    
});
