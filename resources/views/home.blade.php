@extends('layouts.master')

@section('title', 'Home | AppEntrega')

@section('content')
        
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
                        <li class="item-pedido">
                            {{ $pedido->produto }} - {{ $pedido->descricao }} <br/>
                            {{ $pedido->estado }} | {{ $pedido->cidade }} | {{ $pedido->bairro }}
                        </li>
                        
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
        <img src="https://unsplash.it/1200/720">
        <p class="content">{{ $content }}</p>
    @endif
@endsection