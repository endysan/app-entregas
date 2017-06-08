@extends('layouts.master')
@section('title', 'Todos os pedidos')

@section('css')
<link rel="stylesheet" href="{{ url('css/list-pedido.css') }}">
@endsection

@section('content')

<ul class="lista-pedidos">
<h2>Pedidos disponíveis</h2>
<a href="{{ url('mapa-pedidos') }}">Quer uma visão melhor? Acesse o mapa</a>
@foreach($pedidos as $pedido)         
    <li>
        <a id="{{ $pedido->id }}" class="item-pedido" href="{{ url('pedido/'.$pedido->id) }}">
            <span class="titulo-pedido">{{ $pedido->produto }}</span> - {{ $pedido->descricao }} 
            
            @if($pedido->id_usuario == auth()->user()->id) <!-- SE FOR DONO DO PEDIDO -->
                <svg height="25" width="25">
                <circle cx="10" cy="10" r="4" stroke="#33c66c" stroke-width="3" fill="#33c66c" />
                </svg>
            @endif <!-- FIM DONO PEDIDO -->
            <br/>
            {{ $pedido->estado }} | {{ $pedido->cidade }} | {{ $pedido->bairro }}
            <p class="distancia">Distância: <span id="distancia{{ $pedido->id }}"></span></p>
        </a>    
    </li>           
@endforeach

@endsection

@section('script')
<script>
$(document).ready(function(){
    
    @if(auth()->check())
        //SE USUARIO ESTIVER LOGADO
        //E SE OS VALORES DE ENDEREÇO DO USUARIO ESTIVEREM PREENCHIDOS
        @if(isset(auth()->user()->bairro) && isset(auth()->user()->cidade) && isset(auth()->user()->estado))
        
        var origin = "{{ auth()->user()->bairro }}, {{ auth()->user()->cidade }}, {{ auth()->user()->estado }}";
        
        @foreach($pedidos as $pedido)
        var destination = "{{ $pedido->bairro }}, {{ $pedido->cidade }}, {{ $pedido->estado }}";

            $.ajax({
                type: "GET",
                url: "{{ url('maps/distance/') }}/"+origin+"/"+destination,
                success: function(response){
                    var data = JSON.parse(response);
                    
                    //PARA CADA SPAM com classe distancia, colocar o texto
                    $("#distancia{{ $pedido->id }}").text(data.rows[0].elements[0].distance.text);
                },
                error: function(error){
                    console.log("ERRO, mapa: ", error);
                }
            });
        @endforeach
        
        @endif //FIM IF ISSET
    @endif //FIM IF AUTH CHECK
});
</script>
@endsection