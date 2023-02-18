<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('clear_cache', function () {
    \Artisan::call('optimize:clear');
    return redirect()->route('home')->with("success", "Cache is cleared");
});


Auth::routes();


Route::group(['middleware' => ['auth', 'check_lang']], function () {

    /* Resource Route */
    Route::resource('user', App\Http\Controllers\admin\UserController::class);
    Route::resource('customer', App\Http\Controllers\admin\CustomerController::class);
    Route::resource('item_name', App\Http\Controllers\admin\ItemNameController::class);
    Route::resource('item_sales', App\Http\Controllers\admin\ItemSalesController::class);
    Route::resource('item_purchase', App\Http\Controllers\admin\ItemPurchaseController::class);


    /*Single Post Route*/
    Route::post('/profile_update', [App\Http\Controllers\admin\UserController::class, 'profile_update'])->name('profile-update');
    Route::post('/bank_update', [App\Http\Controllers\admin\CustomerController::class, 'bank_update'])->name('bank-update');
    Route::post('/change_password', [App\Http\Controllers\admin\UserController::class, 'change_password'])->name('change-password');
    Route::post('/import', [App\Http\Controllers\admin\CustomerController::class, 'import'])->name('import');

    /*Single Get Route*/
    Route::get('/profile', [App\Http\Controllers\admin\UserController::class, 'profile'])->name('profile');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\admin\UserController::class, 'profile'])->name('profile');
    Route::get('/english', [App\Http\Controllers\admin\UserController::class, 'english'])->name('english');
    Route::get('/gujarati', [App\Http\Controllers\admin\UserController::class, 'gujarati'])->name('gujarati');

    /*Single Report Filter Route*/
    Route::get('/customer_report', [App\Http\Controllers\admin\ReportController::class, 'customer_report'])->name('customer-report');
    Route::get('/customer_report_show', [App\Http\Controllers\admin\ReportController::class, 'customer_report_show'])->name('customer-report-show');
    Route::get('/customer_report_show_pdf', [App\Http\Controllers\admin\ReportController::class, 'customer_report_show_pdf'])->name('customer-report-show-pdf');
    Route::get('/item_name_report', [App\Http\Controllers\admin\ReportController::class, 'item_name_report'])->name('item-name-report');
    Route::get('/item_name_report_show', [App\Http\Controllers\admin\ReportController::class, 'item_name_report_show'])->name('item-name-report-show');
    Route::get('/item_name_report_show_pdf', [App\Http\Controllers\admin\ReportController::class, 'item_name_report_show_pdf'])->name('item-name-report-show-pdf');
    Route::get('/item_sales_report', [App\Http\Controllers\admin\ReportController::class, 'item_sales_report'])->name('item-sales-report');
    Route::get('/item_sales_report_show', [App\Http\Controllers\admin\ReportController::class, 'item_sales_report_show'])->name('item-sales-report-show');
    Route::get('/item_sales_report_show_pdf', [App\Http\Controllers\admin\ReportController::class, 'item_sales_report_show_pdf'])->name('item-sales-report-show-pdf');
    Route::get('/item_purchase_report', [App\Http\Controllers\admin\ReportController::class, 'item_purchase_report'])->name('item-purchase-report');
    Route::get('/item_purchase_report_show', [App\Http\Controllers\admin\ReportController::class, 'item_purchase_report_show'])->name('item-purchase-report-show');
    Route::get('/item_purchase_report_show_pdf', [App\Http\Controllers\admin\ReportController::class, 'item_purchase_report_show_pdf'])->name('item-purchase-report-show-pdf');

    /*Single Report Pdf Route*/
    Route::get('/customer_report_pdf', [App\Http\Controllers\admin\ReportController::class, 'customer_report_pdf'])->name('customer-report-pdf');
    Route::get('/item_name_report_pdf', [App\Http\Controllers\admin\ReportController::class, 'item_name_report_pdf'])->name('item-name-report-pdf');
    Route::get('/item_sales_report_pdf', [App\Http\Controllers\admin\ReportController::class, 'item_sales_report_pdf'])->name('item-sales-report-pdf');
    Route::get('/item_purchase_report_pdf', [App\Http\Controllers\admin\ReportController::class, 'item_purchase_report_pdf'])->name('item-purchase-report-pdf');

    Route::get('item_sales_report_export', [App\Http\Controllers\admin\ReportController::class, 'item_sales_report_export'])->name('item_sales_report_export');
    Route::get('item_name_report_export', [App\Http\Controllers\admin\ReportController::class, 'item_name_report_export'])->name('item_name_report_export');
    Route::get('customer_report_export', [App\Http\Controllers\admin\ReportController::class, 'customer_report_export'])->name('customer_report_export');
    Route::get('item_purchase_report_export', [App\Http\Controllers\admin\ReportController::class, 'item_purchase_report_export'])->name('item_purchase_report_export');
});
