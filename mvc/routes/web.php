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
Route::get('/user/connection', 'UserController@connection');


// Route POST pour le user
Route::post('/user/connection', 'UserController@login');
Route::post('/user/store', 'UserController@store');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@delete');

// Route GET pour les livres
Route::get('/livres', 'LivreController@index');
Route::get('/livres', 'LivreController@index');



Route::dispatch();
