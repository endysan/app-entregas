@extends('layouts.master')

@section('title')
{{ $pedido->produto }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('css/list-pedido.css') }}">
@endsection

@section('content')
    <div class="pedido-container">
        <h3>{{ $pedido->produto }}</h3>
        <p class="data-entrega">Data de Entrega: {{ Carbon\Carbon::parse($pedido->dt_entrega)->format('d/m/Y') }}</p>
        <!-- <img src="" alt="Imagem do produto"/> -->

        <div class="description-area">
            Descrição: {{ $pedido->descricao }} <br>

            @if($pedido->status == 'iniciado')
                    <p class="aceito">Confirme o Entregador</p>
            @elseif ($pedido->status == 'confirmaçao')
                <p class="aguardando">Aguardando Entregador</p>
            @endif
        </div>

        @if(auth()->user()->id_entregador != null && $aceito->id_entregador != auth()->user()->id_entregador)
        <form method="POST" action="{{ url('pedido/entrega') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id_pedido" value="{{ $pedido->id }}">
            <input type="hidden" name="id_entregador" value="{{ auth()->user()->id_entregador }}">
            <button id="bt_aceitar" class="button button-purple" type="submit">Aceitar</button>
        </form>
        @elseif($aceito->id_entregador == auth()->user()->id_entregador)
            <p>Entrega já aceita</p>
        @endif
        <hr/>
        <h5>Aceito por: </h5>
        <p>{{ $aceito->email }}</p>

        @if($pedido->id_usuario == auth()->user()->id)
            @if($pedido->status == 'aceito')
                <p class="telefone">{{ $aceito->telefone }}</p>
                <p class="whatsapp">{{ $aceito->whatsapp }}</p>
            @else
            <button id="bt_entrega" class="button button-purple">Aceitar entregador</button>
            @endif
        @endif
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    var idPedido = {{ $pedido->id }};
    var idEntregador = {{ $aceito->id_entregador }};
    var
    console.log('chame o ajax');
    $('#bt_entrega').on('click', function(){
        $.ajax({
            type: "POST",
            url: "",
            success: function(){},
            error: function(){}
        });
    });
    
});
</script>
@endsection