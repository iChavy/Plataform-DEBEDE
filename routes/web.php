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
// Bank
Route::get('/banks','BankController@index');
Route::get('/bank/{id}','BankController@show');
Route::post('/bank/create','BankController@store');
Route::put('/bank/update/{id}','BankController@update');
Route::delete('/bank/delete/{id}','BankController@destroy');

// Gender
Route::get('/genders','GenderController@index');
Route::get('/gender/{id}','GenderController@show');
Route::post('/gender/create','GenderController@store');
Route::put('/gender/update/{id}','GenderController@update');
Route::delete('/gender/delete/{id}','GenderController@destroy');

// CoinPack
Route::get('/coinpacks','CoinPackController@index');
Route::get('/coinpack/{id}','CoinPackController@show');
Route::post('/coinpack/create','CoinPackController@store');
Route::put('/coinpack/update/{id}','CoinPackController@update');
Route::delete('/coinpack/delete/{id}','CoinPackController@destroy');

// PaymentMethod
Route::get('/paymentmethods','PaymentMethodController@index');
Route::get('/paymentmethod/{id}','PaymentMethodController@show');
Route::post('/paymentmethod/create','PaymentMethodController@store');
Route::put('/paymentmethod/update/{id}','PaymentMethodController@update');
Route::delete('/paymentmethod/delete/{id}','PaymentMethodController@destroy');