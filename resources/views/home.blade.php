﻿@extends('layouts.master')

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

            @if (session()->has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session()->get('success') }}</li>
                </ul>
            </div>
            @endif

        <h2 class="title-home">Bem vindo ao nosso app de entregas!</h2>
        <hr/>
        <img class="img-home" src="http://i.imgur.com/weAQq8d.jpg">
        <p class="content">{{ $content }}</p>
    @endif
@endsection