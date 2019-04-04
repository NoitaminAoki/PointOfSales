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

Route::get('/book', ['uses' => 'BookController@index', 'as' => 'index-book' ]);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'infomasi/toko', 'as' => 'informasi.', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'ProfileController@index', 'as' => 'index']);
    Route::get('/add', ['uses' => 'ProfileController@add', 'as' => 'add']);
    Route::post('/save', ['uses' => 'ProfileController@save', 'as' => 'save']);
    Route::get('/edit/{id}', ['uses' => 'ProfileController@edit', 'as' => 'edit']);
    Route::post('/update', ['uses' => 'ProfileController@update', 'as' => 'update']);
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'index']);
});


Route::group(['prefix' => 'transaction', 'as' => 'transaction.', 'middleware' => 'auth'],function()
{
    Route::get('/', ['uses' => 'TransactionController@list', 'as' => 'list']);
    Route::get('/add', ['uses' => 'TransactionController@add', 'as' => 'add']);
    Route::post('/save', ['uses' => 'TransactionController@save', 'as' => 'save']);
    Route::get('/paid/{id}', ['uses' => 'TransactionController@paid', 'as' => 'paid']);
    Route::post('/update', ['uses' => 'TransactionController@update', 'as' => 'update']);
    Route::post('/checkout', ['uses' => 'TransactionController@checkout', 'as' => 'checkout']);
    Route::get('/delete/{id}', ['uses' => 'TransactionController@delete', 'as' => 'delete']);
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth','role.admin']], function() {

    Route::get('/', ['uses' => 'UserController@list', 'as' => 'list']);
    Route::get('/edit/{id}', ['uses' => 'UserController@edit', 'as' => 'edit']);
    Route::get('/add', ['uses' => 'UserController@add', 'as' => 'add']);
    Route::post('/update', ['uses' => 'UserController@update', 'as' => 'update']);
    Route::post('/save', ['uses' => 'UserController@save', 'as' => 'save']);
    Route::get('/delete/{id}', ['uses' => 'UserController@delete', 'as' => 'delete']);
});

Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => 'auth'], function() {
	Route::get('/', ['uses' => 'ProductController@list', 'as' => 'list']);
	Route::get('/add', ['uses' => 'ProductController@add', 'as' => 'add']);
	Route::get('/report', ['uses' => 'ProductController@report', 'as' => 'report']);
	Route::post('/save', ['uses' => 'ProductController@save', 'as' => 'save']);
	Route::get('/edit/{id}', ['uses' => 'ProductController@edit', 'as' => 'edit']);
	Route::get('/get/{id?}', ['uses' => 'ProductController@get', 'as' => 'get']);
	Route::post('/update', ['uses' => 'ProductController@update', 'as' => 'update']);
	Route::get('/delete/{id}', ['uses' => 'ProductController@delete', 'as' => 'delete']);
});

Route::group(['prefix' => 'kategori', 'as' => 'kategori.', 'middleware' => 'auth'], function() {
	Route::get('/', ['uses' => 'kategoriController@list', 'as' => 'list']);
	Route::get('/add', ['uses' => 'kategoriController@add', 'as' => 'add']);
	Route::post('/save', ['uses' => 'kategoriController@save', 'as' => 'save']);
	Route::get('/edit/{id}', ['uses' => 'kategoriController@edit', 'as' => 'edit']);
	Route::post('/update', ['uses' => 'kategoriController@update', 'as' => 'update']);
	Route::get('/delete/{id}', ['uses' => 'kategoriController@delete', 'as' => 'delete']);
});

Route::group(['prefix' => 'unit', 'as' => 'unit.', 'middleware' => 'auth'], function() {
	Route::get('/', ['uses' => 'unitController@list', 'as' => 'list']);
	Route::get('/add', ['uses' => 'unitController@add', 'as' => 'add']);
	Route::post('/save', ['uses' => 'unitController@save', 'as' => 'save']);
	Route::get('/edit/{id}', ['uses' => 'unitController@edit', 'as' => 'edit']);
	Route::post('/update', ['uses' => 'unitController@update', 'as' => 'update']);
	Route::get('/delete/{id}', ['uses' => 'unitController@delete', 'as' => 'delete']);
});