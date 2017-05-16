@extends('layouts.master')

@section('title', 'Home | AppEntrega')

@section('css')
<link rel="stylesheet" href="{{ url('css/list-pedido.css') }}">
@endsection

@section('content')
        
    @if (Auth::check())
        @if(isset($pedidos))
        <ul class="lista-pedidos">

            @if(auth()->user()->id_entregador == null)
                <h2>Seus pedidos feitos</h2>
                @foreach($pedidos as $pedido)                    
                    @if($pedido->id_usuario == auth()->user()->id)
                    <div class="item-pedido">
                        <li>
                            <a id="{{ $pedido->id }}" class="item-pedido" href="{{ url('pedido/'.$pedido->id) }}">
                                {{ $pedido->produto }} - {{ $pedido->descricao }} <br>
                                @if(count($entrega))
                                    @if ($entrega->status == 'aguardando')
                                    <p class="aceito">Status: Confirme o Entregador</p>
                                    @endif
                                @else
                                    <p class="aguardando">Status: Aguardando Entregador</p>
                                @endif
                            </a>
                        </li>
                    </div>
                    @endif
                @endforeach
            @else
                <h2>Pedidos disponíveis</h2>
                @foreach($pedidos as $pedido)         
                <li>
                    <a id="{{ $pedido->id }}" class="item-pedido" href="{{ url('pedido/'.$pedido->id) }}">
                        {{ $pedido->produto }} - {{ $pedido->descricao }} <br/>
                        {{ $pedido->estado }} | {{ $pedido->cidade }} | {{ $pedido->bairro }}
                    </a>
                </li>           
                @endforeach
            @endif
        </ul>
        
        @else
            <p class="no-pedidos">Você não fez nenhum pedido</p>
            <a class="button button-white" href="#">Criar Agora</a>
        @endif

    @else

            @if (session()->has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session()->get('success') }}</li>
                </ul>
            </div>
            @endif

        <h2 class="title-home">Bem vindo ao nosso app de entregas!</h2>
        <hr/>
        <img class="img-home" src="{{ url('img/apresentacao.jpg') }}">
        <p class="content">{{ $content }}</p>
    @endif
@endsection