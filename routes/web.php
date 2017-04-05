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
Route::get('/checkout', 'CheckoutController@index');
Route::get('/maps', 'MapsController@index');
Route::get('maps/distance', 'MapsController@calculateDistance');

//GOOGLE MAPS
Route::get('/googled7bc6b7efc8f1591.html', function(){
    return view('googled7bc6b7efc8f1591.html');
});

//POST REQUESTS
Route::post('/login', 'LoginController@enter');
Route::post('/cadastro', 'CadastroController@store');
Route::post('/checkout', 'CheckoutController@create');


// PAGSEGURO
Route::post('/pagseguro/redirect', [
    'uses' => 'CheckoutController@redirect',
    'as' => 'pagseguro.redirect',
]);
Route::post('/pagseguro/notification', [
    'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
    'as' => 'pagseguro.notification',
]);