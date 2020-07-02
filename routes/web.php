<?php

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

Route::group(['middleware'=>'guest'], function(){

Route::get('/','adminController@index');

Route::get('/login','admin@login');
Route::post('/login','admin@login_post');
});

Route::group(['middleware'=>'admin'], function(){
Route::get("/home", 'admin@index');
// ======================= Factories Routs =======================
Route::get('/addFactory',"FactoryController@index");
Route::post('/addFactory',"FactoryController@create");
Route::get('/factories',"FactoryController@show");
Route::get('/factories/edit/{id}',"FactoryController@edit");
Route::post('/factories/edit',"FactoryController@update");
Route::get('/factories/delete/{id}',"FactoryController@destroy");

// ==========================Customers Routs ========================================
Route::get('/addCustomer',"ClientsController@index");
Route::post('/addCustomer',"ClientsController@create");
Route::get('customer', 'ClientsController@show');
Route::get('customer/edit/{id}', 'ClientsController@edit');
Route::post('customer/edit', 'ClientsController@update');
Route::get('customer/delete/{id}', 'ClientsController@destroy');
// ==========================Product Routs ========================================
Route::resource('products','ProductController');

// ========================================================================
// ==========================Return Invoices Routs Mark ========================================
Route::get('returnInvoices/search-pro','ReturnInvoicesController@search_pro');
Route::post('returnInvoices/add_to_cart','ReturnInvoicesController@add_to_cart');
Route::get('returnInvoices/update-qty/{id}/{value}','ReturnInvoicesController@update_qty');
Route::post('returnInvoices/calc-total-cart','ReturnInvoicesController@calc_total_cart');
    Route::post('returnInvoices/remove-cart/{id}/','ReturnInvoicesController@remove_from_cart');
Route::resource('returnInvoices','ReturnInvoicesController');

// ========================================================================
// ==========================Invoice Routs==============================================

Route::get('Invoices/search-pro','InvoicesController@search_pro');
Route::post('Invoices/add_to_cart','InvoicesController@add_to_cart');
Route::get('Invoices/update_price_D/{id}/{value}/{price_D}','InvoicesController@update_price_D');
Route::get('Invoices/update-qty/{id}/{value}','InvoicesController@update_qty');
Route::post('invoices/calc-total-cart','InvoicesController@calc_total_cart');
Route::post('invoices/remove-cart/{id}','InvoicesController@deleteFromCart');
Route::post('invoices/create','InvoicesController@save_invoice');


Route::resource('invoices','InvoicesController');

// Route::get('invoices/getProduct','InvoicesController@get_products');
// Route::post('invoices/create','InvoicesController@get_products');

Route::get('logout', function(){
auth()->logout();
return redirect('login');
});




});



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
