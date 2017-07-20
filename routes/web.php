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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('profile', 'UserController');

Route::get('/profile', 'UserController@index');

Route::resource('newOrder', 'OrderController');
Route::get('/newOrder', 'OrderController@newOrder');
Route::get('/allOrders', 'OrderController@allOrders');
Route::get('/getProduct', 'OrderController@getProduct');
Route::get('/getAllProduct', 'OrderController@getAllProduct');
Route::get('/getSqFeetRate', 'OrderController@getSqFeetRate');
Route::get('/getTax', 'OrderController@getTax');
Route::get('/store', 'OrderController@store');
Route::get('/getApproved/{id}', 'OrderController@getApproved');
Route::get('/approve/{id}', 'OrderController@approve');
Route::resource('updateOrder', 'OrderController');
Route::resource('removeOrder', 'OrderController');
Route::get('/orderDetail/{id}', 'OrderController@orderDetail');
Route::get('/filterByClient/{id}', 'OrderController@filterByClient');


Route::resource('newClient', 'ClientController');
Route::resource('removeClient', 'ClientController');
Route::resource('updateClient', 'ClientController');
Route::get('/newClient', 'ClientController@newClient');
Route::get('/allClients', 'ClientController@allClients');

Route::resource('newProduct', 'ProductController');
Route::resource('addProduct', 'ProductController');
Route::resource('removeProduct', 'ProductController');
Route::resource('updateProduct', 'ProductController');
Route::get('/newProduct', 'ProductController@newProduct');
Route::post('/allProducts', 'ProductController@allProducts');
Route::get('/allProducts', 'ProductController@allProducts');
Route::get('/allProducts/filter', 'ProductController@filter');

Route::resource('Register', 'RegisterController');

Route::resource('allTaxes', 'TaxController');
