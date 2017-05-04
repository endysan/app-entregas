<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container">
        
        @if (Auth::check())
            
            
            @if(isset($pedidos))
            <ul class="lista-pedidos">
            @if(auth()->user()->id_entregador == null)
            <h2>Seus pedidos feitos</h2>
            @foreach($pedidos as $pedido)                    
                @if($pedido->id_usuario == auth()->user()->id)
                    <li class="item-pedido">{{ $pedido->produto }} - {{ $pedido->descricao }}</li>
                @endif
            @endforeach
            @else
            <h2>Pedidos disponíveis</h2>
                @foreach($pedidos as $pedido)                    
                        <li class="item-pedido">{{ $pedido->produto }} - {{ $pedido->descricao }}</li>
                @endforeach
            @endif
            </ul>
            
            @else
            <p class="no-pedidos">Você não fez nenhum pedido</p>
            <a class="button button-white" href="#">Criar Agora</a>
            @endif

        @else
            <h2>Home App Entrega</h2>
            <hr/>

            <p class="content">{{ $content }}</p>
        @endif
    </div>
    @include('layouts.footer')
</body>
</html>