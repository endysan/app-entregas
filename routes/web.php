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

/*
|--------------------------
| Rotas de páginas (Views)
|--------------------------
 */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'LoginController@index');
Route::get('/logout', 'LoginController@destroy');
Route::get('/cadastro', 'CadastroController@index');

Route::post('/cadastro', 'CadastroController@store');
Route::post('/login', 'LoginController@enter');