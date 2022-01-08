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

// AgeRestriction
Route::get('/agerestrictions','AgeRestrictionController@index');
Route::get('/agerestriction/{id}','AgeRestrictionController@show');
Route::post('/agerestriction/create','AgeRestrictionController@store');
Route::put('/agerestriction/update/{id}','AgeRestrictionController@update');
Route::delete('/agerestriction/delete/{id}','AgeRestrictionController@destroy');

// Country
Route::get('/countries','CountryController@index');
Route::get('/country/{id}','CountryController@show');
Route::post('/country/create','CountryController@store');
Route::put('/country/update/{id}','CountryController@update');
Route::delete('/country/delete/{id}','CountryController@destroy');

// Role
Route::get('/roles','RoleController@index');
Route::get('/role/{id}','RoleController@show');
Route::post('/role/create','RoleController@store');
Route::put('/role/update/{id}','RoleController@update');
Route::delete('/role/delete/{id}','RoleController@destroy');

// Functionality
Route::get('/functionalities','FunctionalityController@index');
Route::get('/functionality/{id}','FunctionalityController@show');
Route::post('/functionality/create','FunctionalityController@store');
Route::put('/functionality/update/{id}','FunctionalityController@update');
Route::delete('/functionality/delete/{id}','FunctionalityController@destroy');

// GameGenre
Route::get('/gamegenres','GameGenreController@index');
Route::get('/gamegenre/{id}','GameGenreController@show');
Route::post('/gamegenre/create','GameGenreController@store');
Route::put('/gamegenre/update/{id}','GameGenreController@update');
Route::delete('/gamegenre/delete/{id}','GameGenreController@destroy');

// GameTransaction
Route::get('/gametransactions','GameTransactionController@index');
Route::get('/gametransaction/{id}','GameTransactionController@show');
Route::post('/gametransaction/create','GameTransactionController@store');
Route::put('/gametransaction/update/{id}','GameTransactionController@update');
Route::delete('/gametransaction/delete/{id}','GameTransactionController@destroy');

// Library
Route::get('/libraries','LibraryController@index');
Route::get('/library/{id}','LibraryController@show');
Route::post('/library/create','LibraryController@store');
Route::put('/library/update/{id}','LibraryController@update');
Route::delete('/library/delete/{id}','LibraryController@destroy');

// GameWishList
Route::get('/gamewishlists','GameWishListController@index');
Route::get('/gamewishlist/{id}','GameWishListController@show');
Route::post('/gamewishlist/create','GameWishListController@store');
Route::put('/gamewishlist/update/{id}','GameWishListController@update');
Route::delete('/gamewishlist/delete/{id}','GameWishListController@destroy');

// GeographicRestriction
Route::get('/geographicrestrictions','GeographicRestrictionController@index');
Route::get('/geographicrestriction/{id}','GeographicRestrictionController@show');
Route::post('/geographicrestriction/create','GeographicRestrictionController@store');
Route::put('/geographicrestriction/update/{id}','GeographicRestrictionController@update');
Route::delete('/geographicrestriction/delete/{id}','GeographicRestrictionController@destroy');

// BankMethod
Route::get('/bankmethods','BankMethodController@index');
Route::get('/bankmethod/{id}','BankMethodController@show');
Route::post('/bankmethod/create','BankMethodController@store');
Route::put('/bankmethod/update/{id}','BankMethodController@update');
Route::delete('/bankmethod/delete/{id}','BankMethodController@destroy');

// RoleFunctionality
Route::get('/rolefunctionalities','RoleFunctionalityController@index');
Route::get('/rolefunctionality/{id}','RoleFunctionalityController@show');
Route::post('/rolefunctionality/create','RoleFunctionalityController@store');
Route::put('/rolefunctionality/update/{id}','RoleFunctionalityController@update');
Route::delete('/rolefunctionality/delete/{id}','RoleFunctionalityController@destroy');

// UserCoin
Route::get('/usercoins','UserCoinController@index');
Route::get('/usercoin/{id}','UserCoinController@show');
Route::post('/usercoin/create','UserCoinController@store');
Route::put('/usercoin/update/{id}','UserCoinController@update');
Route::delete('/usercoin/delete/{id}','UserCoinController@destroy');

// FollowUp
Route::get('/followups','FollowUpController@index');
Route::get('/followup/{id}','FollowUpController@show');
Route::post('/followup/create','FollowUpController@store');
Route::put('/followup/update/{id}','FollowUpController@update');
Route::delete('/followup/delete/{id}','FollowUpController@destroy');

// WishList
Route::get('/wishlists','WishListController@index');
Route::get('/wishlist/{id}','WishListController@show');
Route::post('/wishlist/create','WishListController@store');
Route::put('/wishlist/update/{id}','WishListController@update');
Route::delete('/wishlist/delete/{id}','WishListController@destroy');

// Valuation
Route::get('/valuations','ValuationController@index');
Route::get('/valuation/{id}','ValuationController@show');
Route::post('/valuation/create','ValuationController@store');
Route::put('/valuation/update/{id}','ValuationController@update');
Route::delete('/valuation/delete/{id}','ValuationController@destroy');

// Transaction
Route::get('/transactions','TransactionController@index');
Route::get('/transaction/{id}','TransactionController@show');
Route::post('/transaction/create','TransactionController@store');
Route::put('/transaction/update/{id}','TransactionController@update');
Route::delete('/transaction/delete/{id}','TransactionController@destroy');

// UserPaymentMethod
Route::get('/userpaymentmethods','UserPaymentMethodController@index');
Route::get('/userpaymentmethod/{id}','UserPaymentMethodController@show');
Route::post('/userpaymentmethod/create','UserPaymentMethodController@store');
Route::put('/userpaymentmethod/update/{id}','UserPaymentMethodController@update');
Route::delete('/userpaymentmethod/delete/{id}','UserPaymentMethodController@destroy');