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
// ==========================Product Routs Mark ========================================
Route::resource('products','ProductController');

// ========================================================================
// ==========================Return Invoices Routs Mark ========================================
Route::resource('returnInvoices','ReturnInvoicesController');

// ========================================================================

Route::get('logout', function(){
auth()->logout();
return redirect('login');
});




});



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
