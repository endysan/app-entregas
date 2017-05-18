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
                            <a id="{{ $pedido->id }}" href="{{ url('pedido/'.$pedido->id) }}">
                                {{ $pedido->produto }} - {{ $pedido->descricao }} <br>
                                @if ($pedido->status == 'confirmaçao')
                                    <p class="confirmaçao">Status: Confirme o Entregador</p>
                                @elseif ($pedido->status == 'iniciado')
                                    <p class="iniciado">Status: Aguardando Entregador</p>
                                @elseif($pedido->status == 'aceito')
                                    <p class="aceito">Status: Pedido Aceito</p>
                                @endif
                                <p>Distância: <span id="distancia{{ $pedido-id }}"></span></p>
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
                        <p>Distância: <span id="distancia{{$pedido->id}}"></span></p>
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
                url: 'maps/distance/'+origin+'/'+destination,
                success: function(response){
                    var data = JSON.parse(response);
                    
                    //PARA CADA SPAM com classe distancia, colocar o texto
                    $('#distancia{{ $pedido->id }}').text(data.rows[0].elements[0].distance.text);
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