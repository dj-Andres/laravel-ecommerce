<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function () {
    return view('prueba');
});

Route::resource('categories', CategoryController::class)->names('categories');
Route::resource('client', ClientController::class)->names('client');
Route::resource('product', ProductController::class)->names('product');
Route::resource('providers', ProviderController::class)->names('providers');
Route::resource('purchases', PurchaseController::class)->names('purchases');
Route::resource('sales', SaleController::class)->names('sales');

Route::get('purchases/pdf/{purchase}',[PurchaseController::class,'pdf'])->name('purchases.pdf');
Route::get('sales/pdf/{sale}',[SaleController::class,'pdf'])->name('sales.pdf');
Route::get('sales/print/{sale}',[SaleController::class,'print'])->name('sales.print');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
