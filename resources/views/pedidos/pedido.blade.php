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
        <p class="data-entrega">Data de Entrega: {{ $pedido->dt_entrega }}</p>
        <img src="" alt="Imagem do produto"/>

        <div class="description-area">
            Descrição: {{ $pedido->descricao }} <br>

            @if(count($entrega))
                @if($entrega->status == 'aguardando')
                    <p class="aceito">Confirme o Entregador</p>
                @endif
            @elseif ($pedido->status == 'iniciado')
                <p class="aguardando">Aguardando Entregador</p>
            @endif
        </div>

        @if(auth()->user()->id_entregador != null && $aceito->id_entregador != auth()->user()->id_entregador)
        <form method="POST" action="{{ url('pedido/entrega') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id_pedido" value="{{ $pedido->id }}">
            <input type="hidden" name="id_entregador" value="{{ auth()->user()->id_entregador }}">
            <button class="button button-purple" type="submit">Aceitar</button>
        </form>
        @elseif($aceito->id_entregador == auth()->user()->id_entregador)
            <p>Entrega já aceita</p>
        @endif
        <hr/>
        <h5>Aceito por: </h5>
        <p>{{ $aceito->email }}</p>

        @if($pedido->id_usuario == auth()->user()->id)
        <button class="button button-purple">Aceitar entregador</button>
        @endif
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    console.log('chame o ajax');
});
</script>
@endsection