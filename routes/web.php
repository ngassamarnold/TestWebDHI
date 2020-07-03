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
Route::group(['middleware'=>'auth'],function (){
        Route::get('/add-products', 'ProduitsController@create')->name('ProduitsCreate');
        Route::post('/save-products', 'ProduitsController@store')->name('Produitstore');
        Route::get('/liste-commandes-non-livre', 'CommandesController@index')->name('ListCommandesNonLivre');
        Route::get('/livrer-cmd/{reference}', 'CommandesController@livrer')->name('livrerCommandes');

        Route::get('/liste-commandes-livre', 'CommandesController@indexLivre')->name('ListCommandesLivre');

        Route::get('/produits', 'ProduitsController@ListProduct')->name('produits');
});



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
