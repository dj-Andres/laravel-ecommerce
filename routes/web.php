<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
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

Route::get('purchases/upload/{purchase}', [PurchaseController::class, 'upload'])->name('purchase.upload');
Route::get('change_status/purchases/{purchase}', [PurchaseController::class, 'change_status'])->name('purchase.change_status');
Route::get('change_status/product/{pruduct}', [ProductController::class, 'change_status'])->name('change.status.product');
Route::get('change_status/sales/{sale}', [SaleController::class, 'change_status'])->name('sale.change_status');

Route::get('purchases/pdf/{purchase}', [PurchaseController::class, 'pdf'])->name('purchases.pdf');
Route::get('sales/pdf/{sale}', [SaleController::class, 'pdf'])->name('sales.pdf');
Route::get('sales/print/{sale}', [SaleController::class, 'print'])->name('sales.print');
Route::get('sales/report_day', [ReportController::class, 'report_day'])->name('report.report_day');
Route::get('sales/report_date', [ReportController::class, 'report_date'])->name('report.report_date');
Route::post('sales/report_results', [ReportController::class, 'report_results'])->name('report.report_results');


Route::resource('Business', BusinessController::class)->only(['index', 'update'])->names('business');
Route::resource('printer', PrinterController::class)->only(['index', 'update'])->names('printer');

Route::resource('users', UserController::class)->names('users');
Route::resource('roles', RolesController::class)->names('roles');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');