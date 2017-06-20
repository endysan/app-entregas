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
                <p class="iniciado">Aguardando Entregador</p>
                @php
                    $isAceito = false;
                @endphp
            @elseif ($pedido->status == 'confirmaçao')
                <p class="confirmaçao">Confirme o Entregador</p>
            @elseif ($pedido->status == 'aceito')
                <p class="aceito">Pedido aceito!</p>
                <div>
                    @php
                        $dono = App\User::where('id', $pedido->id_usuario)->first();
                    @endphp

                    <p><strong>Solicitado por: {{ $dono->name }}</strong></p>
                    <p>
                        <span class="icon icon-whats"></span>
                        @if($dono->whatsapp == null) Não possui
                            @else {{ $dono->whatsapp }}
                        @endif
                    </p>
                    <p>
                    <span class="icon icon-tel"></span>
                    @if($dono->telefone == null) Não possui
                        @else {{ $dono->telefone }}
                    @endif
                    </p>
                </div>
                <hr/>
                <div>
                    <p><strong>Entregador: {{ auth()->user()->name }}</strong></p>
                    <p>
                        <span class="icon icon-whats"></span>
                        @if (auth()->user()->whatsapp == null) Não possui
                        @else {{ auth()->user()->whatsapp }}
                        @endif
                    </p>
                    <p>
                        <span class="icon icon-tel"></span>
                        @if (auth()->user()->telefone == null) Não possui
                        @else {{ auth()->user()->telefone }}
                        @endif
                    </p>
                </div>
                <br/>
                @php
                    $isAceito = true;
                @endphp
            @endif
        </div>

        <!-- SE VOCE FOR UM ENTREGADOR -->
        @if(auth()->user()->id_entregador != null)
            <form id="form-aceitar" method="POST" action="{{ url('pedido/addentregador') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id_pedido" value="{{ $pedido->id }}">
                <input type="hidden" name="id_entregador" value="{{ auth()->user()->id_entregador }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <!-- VERIFICA SE VOCE JÁ ACEITOU ESSE PEDIDO -->
                @foreach($aceitos as $aceito)
                    @if($aceito->id_entregador == auth()->user()->id_entregador)
                        <p>Você já aceitou esse pedido</p>
                        @php
                            $isAceito = true;
                        @endphp
                    @endif
                @endforeach
                <!-- FIM VERIFICAÇAO -->
                @if(!isset($isAceito) || $isAceito == false)
                    <button id="bt_aceitar" class="button button-purple" type="submit">Aceitar</button>
                @endif
            </form>
        @endif
        <!-- FIM SE FOR ENTREGADOR -->

        <hr/>

        <!-- SE ALGUEM ACEITO SEU PEDIDO, LISTAR AQUI -->
        @if(count($aceitos) && $pedido->status != 'aceito')
            <h5>Aceito por: </h5>
            @foreach($aceitos as $aceito)
                
                {{ $aceito->email }}
                
                @if($pedido->id_usuario == auth()->user()->id)
                    <button class="button" onclick="idEntregador={{ $aceito->id_entregador }};
                        idPedido={{ $pedido->id }};
                        aceitarEntregador();">
                        Aceitar entregador
                    </button> <br/> 
                @else
                    <br/>
                @endif
            @endforeach
        @endif
        <!-- FIM LISTA -->
        
        <br/>

        <!-- SE VOCE É O DONO DO PEDIDO -->
<!--        
            @if($pedido->status == 'aceito')
                
            @elseif($pedido->status == 'confirmaçao')

                <button id="bt_entrega" class="button button-purple"></button>
            @endif-->
        <!-- FIM DONO DO PEDIDO -->

    </div>
@endsection

@section('script')

<script>
var idEntregador = 0;
var idPedido = 0;

function aceitarEntregador(){
     $.ajax({
        type: "POST",
        url: "{{ url('pedido/entrega') }}",
        data: {_token:'{{ csrf_token() }}', id_pedido:this.idPedido, id_entregador:this.idEntregador },
        success: function(response){
            console.log("SUCESSO ACEITAR: ", response);
            setTimeout(location.reload(), 100);
        },
        error: function(error){
            console.log("ERRO ACEITAR: ", error);
            console.log(data);
        }
    });
    
}

$(document).ready(function(){
    $('#bt_aceitar').on('submit', function(event){
        event.preventDefault();
        
        $.ajax({
            type: "POST",
            url: "{{ url('pedido/addentregador') }}",
            data: { 
                _token: "{{ csrf_token() }}",
                aceitando: $.toJSON($('#form-aceitar').serialize())
            },
            success: function(response){
                console.log("ADD ENTREGADOR: ", response);
                setTimeout(location.reload(), 50);
            },
            error: function(error){
                console.log("ERRO AJAX, ADD ENTREGADOR: ", error);
            }
        });
        
    });
});
</script>

@endsection