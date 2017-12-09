<?php

// PAGINAS
Route::view('/', 'index');
Route::view('/index', 'index')->name('home');
Route::view('/login', 'login')->name('login');
Route::view('/signup', 'signup')->name('signup');

// AuthControl
Route::post('/login', 'AuthController@postLogin');
Route::get('/logout', 'AuthController@getLogout');
Route::post('/signup', 'AuthController@postSignup');

Route::view('/orcamento', 'entregador.orcamento');
Route::get('/perfil/id={id}', function($id){
    $cliente = App\Cliente::find($id);
    return view('perfil', compact('cliente'));
})->name('pedido');

// Grupo de páginas que necessitam estar logado
Route::middleware(['auth'])->group(function(){
        
    // Pagina dashboard 
    Route::prefix('cliente')->group(function(){
        // url = /cliente/dashboard
        Route::view('/dashboard', 'cliente.dashboard')->name('cliente.home');
        Route::view('/perfil', 'cliente.editar_perfil');
        Route::get('/historico', 'PedidosController@getPedidos');

        // Rotas relacionadas aos pedidos    

        Route::prefix('pedido')->group(function(){
            // url = cliente/pedido/criar
            Route::get('/id={id}', 'PedidosController@getPedidoCliente');
            Route::get('/criar', 'PagesController@createPedido');
            Route::post('/criar', 'PedidosController@postCreatePedido');
            Route::post('/editar', 'PedidosController@editar');
        });
        
            
    }); // PREFIX CLIENTE

    // PREFIX ENTREGADOR TODO
    Route::prefix('entregador')->group(function(){
        Route::view('/dashboard', 'entregador.dashboard')->name('entregador.home');
        Route::view('/perfil', 'entregador.editar_perfil');
        Route::get('/mapa-pedidos', 'MapaController@getMapa');

        Route::get('pedido/id={id}', 'PedidosController@getPedidoEntregador');

        Route::get('/pedido-latlng', 'MapaController@getMarcarEndereco');

        Route::get('/veiculos', 'VeiculosController@index');
        Route::prefix('veiculo')->group(function(){
            Route::post('/criar', 'VeiculosController@postCreateVeiculo');
            Route::post('/remover/id={id}', 'VeiculosController@removeVeiculo');
        });
        
    });

}); // MIDDLEWARE AUTH
