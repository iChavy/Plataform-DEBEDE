<?php

use App\Http\Controllers\AgeRestrictionController;
use App\Models\AgeRestriction;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/home', function () {
    return view('home');
});

//SignUp
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/signup', 'CountryController@index');

//Juegos
Route::get('/juegos', function () {
    return view('juegos');
});
Route::get('/crearJuego', function () {
    return view('crearJuego');
});
Route::get('/juegos', 'GameController@index'); Route::get('/juegos', 'GameController@index');  //filtro nombre, ranking y no borrados
//Route::get('/juegos', 'AgeRestrictionController@index'); 

Route::get('/crearJuego', 'AgeRestrictionController@index2');

//Modificar Usuario
Route::get('/modificarUser', function () {
    return view('modificarUser');
});
Route::get('/modificarUser', 'UserController@edit'); //error dos parámetros
Route::put('/modificarUser', 'UserController@update');



//Login
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

//Tarjeta
Route::get('/tarjeta', 'PaymentMethodController@index');


// Bank
Route::get('/banks', 'BankController@index');
Route::get('/bank/{id}', 'BankController@show');
Route::post('/bank/create', 'BankController@store');
Route::put('/bank/update/{id}', 'BankController@update');
Route::put('/bank/borrar/{id}', 'BankController@borrado');
Route::delete('/bank/delete/{id}', 'BankController@destroy');

// Gender
Route::get('/genders', 'GenderController@index');
Route::get('/gender/{id}', 'GenderController@show');
Route::post('/gender/create', 'GenderController@store');
Route::put('/gender/update/{id}', 'GenderController@update');
Route::put('/gender/borrar/{id}', 'GenderController@borrado');
Route::delete('/gender/delete/{id}', 'GenderController@destroy');

// CoinPack
Route::get('/coinpacks', 'CoinPackController@index');
Route::get('/coinpack/{id}', 'CoinPackController@show');
Route::post('/coinpack/create', 'CoinPackController@store');
Route::put('/coinpack/update/{id}', 'CoinPackController@update');
Route::put('/coinpack/borrar/{id}', 'CoinPackController@borrado');
Route::delete('/coinpack/delete/{id}', 'CoinPackController@destroy');

// PaymentMethod
Route::get('/paymentmethods', 'PaymentMethodController@index');
Route::get('/paymentmethod/{id}', 'PaymentMethodController@show');
Route::post('/paymentmethod/create', 'PaymentMethodController@store');
Route::put('/paymentmethod/update/{id}', 'PaymentMethodController@update');
Route::put('/paymentmethod/borrar/{id}', 'PaymentMethodController@borrado');
Route::delete('/paymentmethod/delete/{id}', 'PaymentMethodController@destroy');

// AgeRestriction
//Route::get('/agerestrictions','AgeRestrictionController@index');

Route::get('/agerestrictions', 'AgeRestrictionController@index2');
Route::get('/agerestriction/{id}', 'AgeRestrictionController@show');
Route::post('/agerestriction/create', 'AgeRestrictionController@store');
Route::put('/agerestriction/update/{id}', 'AgeRestrictionController@update');
Route::put('/agerestriction/borrar/{id}', 'AgeRestrictionController@borrado');
Route::delete('/agerestriction/delete/{id}', 'AgeRestrictionController@destroy');

// Country
Route::get('/countries', 'CountryController@index');
Route::get('/country/{id}', 'CountryController@show');
Route::post('/country/create', 'CountryController@store');
Route::put('/country/update/{id}', 'CountryController@update');
Route::put('/country/borrar/{id}', 'CountryController@borrado');
Route::delete('/country/delete/{id}', 'CountryController@destroy');

// Role
Route::get('/roles', 'RoleController@index');
Route::get('/role/{id}', 'RoleController@show');
Route::post('/role/create', 'RoleController@store');
Route::put('/role/update/{id}', 'RoleController@update');
Route::put('/role/borrar/{id}', 'RoleController@borrado');
Route::delete('/role/delete/{id}', 'RoleController@destroy');

// Functionality
Route::get('/functionalities', 'FunctionalityController@index');
Route::get('/functionality/{id}', 'FunctionalityController@show');
Route::post('/functionality/create', 'FunctionalityController@store');
Route::put('/functionality/update/{id}', 'FunctionalityController@update');
Route::put('/functionality/borrar/{id}', 'FunctionalityController@borrado');
Route::delete('/functionality/delete/{id}', 'FunctionalityController@destroy');

// GameGenre
Route::get('/gamegenres', 'GameGenreController@index');
Route::get('/gamegenre/{id}', 'GameGenreController@show');
Route::post('/gamegenre/create', 'GameGenreController@store');
Route::put('/gamegenre/update/{id}', 'GameGenreController@update');
Route::put('/gamegenre/borrar/{id}', 'GameGenreController@borrado');
Route::delete('/gamegenre/delete/{id}', 'GameGenreController@destroy');

// GameTransaction
Route::get('/gametransactions', 'GameTransactionController@index');
Route::get('/gametransaction/{id}', 'GameTransactionController@show');
Route::post('/gametransaction/create', 'GameTransactionController@store');
Route::put('/gametransaction/update/{id}', 'GameTransactionController@update');
Route::put('/gametransaction/borrar/{id}', 'GameTransactionController@borrado');
Route::delete('/gametransaction/delete/{id}', 'GameTransactionController@destroy');

// Library
Route::get('/libraries', 'LibraryController@index');
Route::get('/library/{id}', 'LibraryController@show');
Route::post('/library/create', 'LibraryController@store');
Route::put('/library/update/{id}', 'LibraryController@update');
Route::put('/library/borrar/{id}', 'LibraryController@borrado');
Route::delete('/library/delete/{id}', 'LibraryController@destroy');

// GameWishList
Route::get('/gamewishlists', 'GameWishListController@index');
Route::get('/gamewishlist/{id}', 'GameWishListController@show');
Route::post('/gamewishlist/create', 'GameWishListController@store');
Route::put('/gamewishlist/update/{id}', 'GameWishListController@update');
Route::put('/gamewishlist/borrar/{id}', 'GameWishListController@borrado');
Route::delete('/gamewishlist/delete/{id}', 'GameWishListController@destroy');

// GeographicRestriction
Route::get('/geographicrestrictions', 'GeographicRestrictionController@index');
Route::get('/geographicrestriction/{id}', 'GeographicRestrictionController@show');
Route::post('/geographicrestriction/create', 'GeographicRestrictionController@store');
Route::put('/geographicrestriction/update/{id}', 'GeographicRestrictionController@update');
Route::put('/geographicrestriction/borrar/{id}', 'GeographicRestrictionController@borrado');
Route::delete('/geographicrestriction/delete/{id}', 'GeographicRestrictionController@destroy');

// BankMethod
Route::get('/bankmethods', 'BankMethodController@index');
Route::get('/bankmethod/{id}', 'BankMethodController@show');
Route::post('/bankmethod/create', 'BankMethodController@store');
Route::put('/bankmethod/update/{id}', 'BankMethodController@update');
Route::put('/bankmethod/borrar/{id}', 'BankMethodController@borrado');
Route::delete('/bankmethod/delete/{id}', 'BankMethodController@destroy');

// RoleFunctionality
Route::get('/rolefunctionalities', 'RoleFunctionalityController@index');
Route::get('/rolefunctionality/{id}', 'RoleFunctionalityController@show');
Route::post('/rolefunctionality/create', 'RoleFunctionalityController@store');
Route::put('/rolefunctionality/update/{id}', 'RoleFunctionalityController@update');
Route::put('/rolefunctionality/borrar/{id}', 'RoleFunctionalityController@borrado');
Route::delete('/rolefunctionality/delete/{id}', 'RoleFunctionalityController@destroy');

// UserCoin
Route::get('/usercoins', 'UserCoinController@index');
Route::get('/usercoin/{id}', 'UserCoinController@show');
Route::post('/usercoin/create', 'UserCoinController@store');
Route::put('/usercoin/update/{id}', 'UserCoinController@update');
Route::put('/usercoin/borrar/{id}', 'UserCoinController@borrado');
Route::delete('/usercoin/delete/{id}', 'UserCoinController@destroy');

// FollowUp
Route::get('/followups', 'FollowUpController@index');
Route::get('/followup/{id}', 'FollowUpController@show');
Route::post('/followup/create', 'FollowUpController@store');
Route::put('/followup/update/{id}', 'FollowUpController@update');
Route::put('/followup/borrar/{id}', 'FollowUpController@borrado');
Route::delete('/followup/delete/{id}', 'FollowUpController@destroy');

// WishList
Route::get('/wishlists', 'WishListController@index');
Route::get('/wishlist/{id}', 'WishListController@show');
Route::post('/wishlist/create', 'WishListController@store');
Route::put('/wishlist/update/{id}', 'WishListController@update');
Route::put('/wishlist/borrar/{id}', 'WishListController@borrado');
Route::delete('/wishlist/delete/{id}', 'WishListController@destroy');

// Valuation
Route::get('/valuations', 'ValuationController@index');
Route::get('/valuation/{id}', 'ValuationController@show');
Route::post('/valuation/create', 'ValuationController@store');
Route::put('/valuation/update/{id}', 'ValuationController@update');
Route::put('/valuation/borrar/{id}', 'ValuationController@borrado');
Route::delete('/valuation/delete/{id}', 'ValuationController@destroy');

// Transaction
Route::get('/transactions', 'TransactionController@index');
Route::get('/transaction/{id}', 'TransactionController@show');
Route::post('/transaction/create', 'TransactionController@store');
Route::put('/transaction/update/{id}', 'TransactionController@update');
Route::put('/transaction/borrar/{id}', 'TransactionController@borrado');
Route::delete('/transaction/delete/{id}', 'TransactionController@destroy');

// UserPaymentMethod
Route::get('/userpaymentmethods', 'UserPaymentMethodController@index');
Route::get('/userpaymentmethod/{id}', 'UserPaymentMethodController@show');
Route::post('/userpaymentmethod/create', 'UserPaymentMethodController@store');
Route::put('/userpaymentmethod/update/{id}', 'UserPaymentMethodController@update');
Route::put('/userpaymentmethod/borrar/{id}', 'UserPaymentMethodController@borrado');
Route::delete('/userpaymentmethod/delete/{id}', 'UserPaymentMethodController@destroy');

// User
Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/create', 'UserController@store');
Route::put('/user/edit/{id}', 'UserController@update');
Route::put('/user/borrar/{id}', 'UserController@borrado');
Route::delete('/user/delete/{id}', 'UserController@destroy');

// Game
Route::get('/game/vistacarro/{id}', 'GameController@vistaCarro');

Route::get('/games', 'GameController@index');
Route::get('/game/{id}', 'GameController@show');
Route::post('/game/create', 'GameController@store');
Route::put('/game/update/{id}', 'GameController@update');
Route::put('/game/borrar/{id}', 'GameController@borrado');
Route::delete('/game/delete/{id}', 'GameController@destroy');
