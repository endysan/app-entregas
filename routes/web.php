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

//Criar sessão, usuário, logout
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'LoginController@index');
Route::get('/logout', 'LoginController@destroy');
Route::get('/cadastro', 'CadastroController@index');

//Editar usuario
Route::get('/editar', 'CadastroController@editar');
Route::get('/editarendereco', 'CadastroController@editarEndereco');
Route::get('/editarsenha', 'CadastroController@editarSenhaView');
Route::get('/areaentregador', 'CadastroController@areaEntregador');

//APIs: Maps e PagSeguro
Route::get('/checkout', 'CheckoutController@index');
Route::get('/maps', 'MapsController@index');
Route::get('maps/distance/{origin}/{destination}', 'MapsController@calculateDistance');

//Pedidos
Route::get('/pedidos', 'PedidosController@index');
Route::get('/historico-pedido/{id}', 'PedidosController@getPedidoByUser');

//CRUDs-------------------------------------------------------------------
Route::get('/login-admin','CrudController@loginView');

Route::get('/list-usuario', 'UsuariosController@listUsuario');
Route::post('/create-usuario', 'UsuariosController@createUsuario');
Route::get('/get-usuario/{id}', 'UsuariosController@getUsuarioById');
Route::put('/edit-usuario/{id}', 'UsuariosController@editUsuario');
Route::delete('/delete-usuario/{id}', 'UsuariosController@deleteUsuario');


Route::get('/list-pedido', 'PedidosController@listPedido');
Route::post('/create-pedido', 'PedidosController@createPedido');
Route::get('/get-pedido/{id}', 'PedidosController@getPedidoById');
Route::put('/edit-pedido/{id}', 'PedidosController@editPedido');
Route::delete('/delete-pedido/{id}', 'PedidosController@deletePedido');


Route::get('/list-entregador', 'EntregadoresController@listEntregador');
Route::post('/create-entregador', 'EntregadoresController@createEntregador');
Route::get('/get-entregador/{id}', 'EntregadoresController@getEntregadorById');
Route::put('/edit-entregador/{id}', 'EntregadoresController@editEntregador');
Route::delete('/delete-entregador/{id}', 'EntregadoresController@deleteEntregador');
//-------------------------------------------------------------------------


//GOOGLE MAPS
Route::get('/googled7bc6b7efc8f1591.html', function(){
    return view('googled7bc6b7efc8f1591.html');
});

//POST REQUESTS
Route::post('/login', 'LoginController@enter');
Route::post('/cadastro', 'CadastroController@store');
Route::post('/checkout', 'CheckoutController@create');
Route::post('/pedido', 'PedidosController@criar');
Route::post('/editar', 'CadastroController@editar');
Route::post('/editarendereco', 'CadastroController@editarEndereco');
Route::post('/editarsenha', 'CadastroController@editarSenha');
Route::post('/areaentregador', 'CadastroController@areaEntregador'); //TEMPORARIO, MUDAR

// PAGSEGURO
Route::post('/pagseguro/redirect', [
    'uses' => 'CheckoutController@redirect',
    'as' => 'pagseguro.redirect',
]);
Route::post('/pagseguro/notification', [
    'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
    'as' => 'pagseguro.notification',
]);