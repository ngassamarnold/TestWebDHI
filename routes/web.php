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

Route::get('/succes', function () {
    return view('commandes.paiement');
});
Route::get('/echec', function () {
    return view('commandes.echec');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/add-products', 'ProduitsController@create')->name('ProduitsCreate')->middleware('auth');
Route::post('/save-products', 'ProduitsController@store')->name('Produitstore')->middleware('auth');




// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
