<?php

use App\Routes\Route;
use App\Controllers\UserController;
use App\Controllers\LivreController;

// Route de base
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Route GET pour le user
Route::get('/user/create', 'UserController@create');
Route::get('/user/show', 'UserController@show');
Route::get('/user/edit', 'UserController@edit');

// Route POST pour le user
Route::post('/user/connection', 'UserController@login');
Route::post('/user/store', 'UserController@store');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@delete');

// Route GET pour les livres
Route::get('/livres', 'LivreController@index');
Route::get('/livre/create', 'LivreController@create');


// Route POST pour le livre
Route::post('/livre/index', 'LivreController@store');

// Route GET pour l'auth'
Route::get('/auth/index', 'AuthController@connection');
Route::get('/auth/logout', 'AuthController@delete');

// Route pour aller chercher tous les clients
Route::get('/user/liste-clients', 'UserController@clients');


// Route POST pour l'auth'
Route::post('/auth/index', 'AuthController@login');



Route::dispatch();
