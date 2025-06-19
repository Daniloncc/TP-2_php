<?php

use App\Routes\Route;
use App\Controllers\ClientController;
use App\Controllers\LivreController;

// Route de base
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Route GET pour le client
Route::get('/client/create', 'ClientController@create');
Route::get('/client/show', 'ClientController@show');
Route::get('/client/edit', 'ClientController@edit');


// Route POST pour le client
Route::post('/client/store', 'ClientController@store');
Route::post('/client/edit', 'ClientController@update');
Route::post('/client/delete', 'ClientController@delete');

// Route GET pour les livres
Route::get('/livres', 'LivreController@index');
Route::get('/livres', 'LivreController@index');



Route::dispatch();
