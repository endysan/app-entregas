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

// PAGINA DE EXIBIR PERFIL------------------------------------
Route::get('/perfil/id={id}', function($id){
    $cliente = App\Cliente::find($id);
    return view('perfil', compact('cliente'));
});

// UPLOAD IMG PERFIL DO USUARIO
Route::post('/perfil/upload', 'AuthController@imgPerfil');
// -----------------------------------------------------------

// Grupo de páginas que necessitam estar logado
Route::middleware(['auth'])->group(function(){
        
    Route::prefix('cliente')->group(function(){
        // url = /cliente/dashboard
        Route::view('/dashboard', 'cliente.dashboard')->name('cliente.home');
        Route::view('/perfil', 'cliente.editar_perfil');
        Route::get('/historico', 'PedidosController@getPedidos');
        
        //Rotas de editar informações
        Route::view('/editar', 'cliente.editar_perfil');
        Route::post('/editar', 'ClienteController@postEditar');

        // Rotas relacionadas aos pedidos    
        Route::prefix('pedido')->group(function(){
            // url = cliente/pedido/criar
            Route::get('/id={id}', 'PedidosController@getPedidoCliente')->name('cliente.pedido');
            Route::get('/criar', 'PagesController@createPedido');
            Route::post('/criar', 'PedidosController@postCreatePedido');
            Route::post('/editar', 'PedidosController@editar');
        });
        
            
    }); // PREFIX CLIENTE

    Route::prefix('entregador')->group(function(){
        Route::view('/dashboard', 'entregador.dashboard')->name('entregador.home');

        Route::view('/editar', 'entregador.editar_perfil');
        Route::post('/editar', 'ClienteController@postEditarEntregador');

        Route::get('/mapa-pedidos', 'MapaController@getMapa');

        Route::get('pedido/id={id}', 'PedidosController@getPedidoEntregador')->name('entregador.pedido');

        Route::get('/pedido-latlng', 'MapaController@getMarcarEndereco');

        Route::get('/veiculos', 'VeiculosController@index');

        Route::prefix('veiculo')->group(function(){
            Route::post('/criar', 'VeiculosController@postCreateVeiculo');
            Route::get('/remover/id={id}', 'VeiculosController@removeVeiculo');
        });
        
    }); //PREFIX ENTREGADOR

}); // MIDDLEWARE AUTH
