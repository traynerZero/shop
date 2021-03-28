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

Route::get('/',"ProductsController@index");

Route::get('/logout',"LoginController@logout");


Route::get('/login',function () {
    return view('login');
});

Route::post('/login/checkUser',[
    'uses' => 'LoginController@signIn',
    'as' => 'f.submit'
]);

Route::post('/login/registerUser',[
    'uses' => 'LoginController@signUp',
    'as' => 'f.submit'
]);


Route::post('/addtoCart',[
    'uses' => 'TransactionController@addtoCart',
    'as' => 'f.submit'
]);

Route::get('/clearCart','TransactionController@clearCart');

Route::get('/viewCart','TransactionController@viewCart');

Route::get('/checkout','TransactionController@checkout');

Route::get('/saveOrder','TransactionController@saveOrder');

Route::get('/admin',"AdminController@index");