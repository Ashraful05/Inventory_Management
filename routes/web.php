<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\POS\SupplierController;
use App\Http\Controllers\POS\CustomerController;
use App\Http\Controllers\POS\UnitController;
use App\Http\Controllers\POS\CategoryController;
use App\Http\Controllers\POS\ProductController;
use App\Http\Controllers\POS\PurchaseController;
use App\Http\Controllers\POS\DefaultController;
use App\Http\Controllers\POS\InvoiceController;
use App\Http\Controllers\POS\StockController;


Route::get('/', function () {
    return view('welcome');
});


Route::controller(DemoController::class)->group(function () {
    Route::get('/about', 'Index')->name('about.page')->middleware('check');
    Route::get('/contact', 'ContactMethod')->name('cotact.page');
});


Route::group(['middleware'=>'auth'],function(){
    // Admin All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');

        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');

    });
    Route::resource('supplier',SupplierController::class);
    Route::resource('customer',CustomerController::class);
    Route::resource('unit',UnitController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::resource('purchase',PurchaseController::class);
    Route::get('pending/purchase',[PurchaseController::class,'PurchasePending'])->name('purchase.pending');
    Route::get('approved/purchase/{id}',[PurchaseController::class,'PurchaseApproved'])->name('purchase.approved');
    Route::get('purchase_daily_report',[PurchaseController::class,'dailyPurchaseReport'])->name('purchase.daily.report');
    Route::get('purchase_daily_report_pdf',[PurchaseController::class,'dailyPurchaseReportPDF'])->name('purchase.daily_report_pdf');

    //Default Controller route....
    Route::get('category_data/ajax',[DefaultController::class,'getCategoryDataByAjax'])->name('get_category');
    Route::get('product_data/ajax',[DefaultController::class,'getProductDataByAjax'])->name('get_product');
    Route::get('check_product_stock/ajax',[DefaultController::class,'checkProductStockByAjax'])->name('check_product_stock');

    //invoice controller route....
    Route::controller(InvoiceController::class)->group(function (){
       Route::prefix('invoice')->group(function (){
         Route::get('all','AllInvoice')->name('invoice_all');
         Route::get('create','CreateInvoice')->name('invoice_create');
         Route::post('save','SaveInvoice')->name('invoice_save');
         Route::get('pending/list','InvoicePendingList')->name('invoice_pending_list');
         Route::get('approve/{id}','InvoiceApprove')->name('invoice_approve');
         Route::get('delete/{id}','DeleteInvoice')->name('invoice_delete');
         Route::post('approve/save/{id}','SaveApprovedInvoice')->name('invoice_approve_save');
         Route::get('printing/list','InvoicePrintingList')->name('print_invoice_list');
         Route::get('print/{id}','InvoicePrintById')->name('print_by_id');
         Route::get('daily/report','InvoiceDailyReport')->name('invoice_daily_report');
         Route::get('daily/report/pdf','InvoiceDailyReportPDF')->name('daily_invoice_report_pdf');
       });
    });

    Route::controller(StockController::class)->group(function (){
       Route::prefix('stock')->group(function (){
         Route::get('report','StockReport')->name('stock_report');
         Route::get('report/pdf','StockReportPDF')->name('stock_report_pdf');
         Route::get('report/supplier-product-wise','SupplierProductWiseStockReport')->name('supplier_product_wise_report');
         Route::get('report/supplier-wise-pdf','SupplierWiseStockReportPDF')->name('supplier_wise_pdf_report');
         Route::get('report/product-wise-pdf','ProductWiseStockReportPDF')->name('product_wise_pdf_report');
       });
    });

    Route::prefix('customer')->group(function(){
       Route::get('credit/report',[CustomerController::class,'CustomerCreditReport'])->name('customer.credit.report');
       Route::get('credit/report/pdf',[CustomerController::class,'CustomerCreditReportPDF'])->name('customer.credit.report.pdf');
       Route::get('edit/invoice/{invoice_id}',[CustomerController::class,'CustomerEditInvoice'])->name('customer.edit.invoice');
       Route::post('update/invoice/{invoice_id}',[CustomerController::class,'CustomerUpdateInvoice'])->name('customer.update.invoice');
       Route::get('invoice/details/pdf/{invoice_id}',[CustomerController::class,'CustomerInvoiceDetailsPDF'])->name('customer.invoice.details');
    });
});








Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Route::get('/contact', function () {
//     return view('contact');
// });
