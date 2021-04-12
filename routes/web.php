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
    return view('auth.login');
});



Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('invoices','App\Http\Controllers\InvoiceController');

Route::resource('sections','App\Http\Controllers\SectionsController');

Route::resource('products','App\Http\Controllers\ProductController');

Route::resource('InvoiceAttachments', 'App\Http\Controllers\InvoiceAttachmentsController');


Route::get('section/{id}','App\Http\Controllers\InvoiceController@getproducts');

Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('download/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@open_file');

Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');

Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoiceController@edit');

Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoiceController@show')->name('Status_show');

Route::post('/Status_Update/{id}', 'App\Http\Controllers\InvoiceController@Status_Update')->name('Status_Update');

Route::resource('Archive', 'App\Http\Controllers\InvoiceAchiveController');

Route::get('Invoice_Paid','App\Http\Controllers\InvoiceController@Invoice_Paid');

Route::get('Invoice_UnPaid','App\Http\Controllers\InvoiceController@Invoice_UnPaid');

Route::get('Invoice_Partial','App\Http\Controllers\InvoiceController@Invoice_Partial');

Route::get('Print_invoice/{id}','App\Http\Controllers\InvoiceController@Print_invoice')->name('invoice.print');

Route::get('export_invoices/', 'App\Http\Controllers\InvoiceController@export');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});

Route::get('invoices_report', 'App\Http\Controllers\Invoices_Report@index');
Route::post('Search_invoices', 'App\Http\Controllers\Invoices_Report@Search_invoices');

Route::get('customers_report', 'App\Http\Controllers\Customers_Report@index')->name("customers_report");
Route::post('Search_customers', 'App\Http\Controllers\Customers_Report@Search_customers');

Route::get('MarkAsRead_all','App\Http\Controllers\InvoiceController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'App\Http\Controllers\InvoiceController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'App\Http\Controllers\InvoiceController@unreadNotifications')->name('unreadNotifications');


Route::get('/{page}', 'App\Http\Controllers\AdminController@index');

