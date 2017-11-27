@extends('template.master')

@section('title', $pedido->titulo)

@section('css')
<link rel="stylesheet" href="{{ url('css/list-pedido.css') }}">
@endsection

@section('content')
    <div class="pedido-container">
        <h3>{{ $pedido->titulo }}</h3>
        <p class="data-entrega">Data de Entrega: {{ Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y') }}</p>
        <!-- <img src="" alt="Imagem do produto"/> -->

        <div class="description-area">
            Descrição: {{ $pedido->descricao }} <br>

            @if($pedido->status == 'aguardando')
                <p class="iniciado">Aguardando Orçamento</p>
            @elseif ($pedido->status == 'aceito')
                <p class="confirmaçao">Confirme o Entregador</p>
            @elseif ($pedido->status == 'finalizado')
                <p class="confirmaçao">Finalizado</p>
            @elseif ($pedido->status == 'cancelado')
                <p class="iniciado">Pedido cancelado</p>

            @elseif ($pedido->status == 'aguardando')
                <p class="aceito">Pedido aceito!</p>

                @endif
                <div>
                    <p><strong>Solicitado por: {{ $pedido->cliente->nome }}</strong></p>
                    <p>
                        <i class="fa fa-whatsapp fa-fw" style="color: #00C600;"></i>
                        @if($pedido->cliente->whatsapp == null) Não possui
                            @else {{ $pedido->cliente->whatsapp }}
                        @endif
                    </p>
                    <p>
                    <i class="fa fa-phone fa-fw"></i>
                    @if($pedido->cliente->whatsapp == null) Não possui
                        @else {{ $pedido->cliente->whatsapp }}
                    @endif
                    </p>
                </div>
                <hr/>
                <!-- 
                <div>
                    <p><strong>Entregador: {{ auth()->user()->name }}</strong></p>
                    <p>
                        <i class="fa fa-whatsapp fa-fw"></i>
                        @if (auth()->user()->whatsapp == null) Não possui
                        @else {{ auth()->user()->whatsapp }}
                        @endif
                    </p>
                    <p>
                        <i class="fa fa-phone fa-fw"></i>
                        @if (auth()->user()->telefone == null) Não possui
                        @else {{ auth()->user()->telefone }}
                        @endif
                    </p>
                </div>
                <br/>
              -->
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
            <button id="bt_cancelar" class="button button-red">Cancelar</button>
        @endif
        <!-- FIM SE FOR ENTREGADOR -->

        <hr/>

        <!-- SE ALGUEM ACEITO SEU PEDIDO, LISTAR AQUI -->
        @if(isset($aceitos))
        @if(count($aceitos) && $pedido->status != 'aceito')
            <h5>Aceito por: </h5>
            @foreach($aceitos as $aceito)
                
                {{ $aceito->email }}
                
                @if($pedido->id_usuario == auth()->user()->id)
                    <button class="button" onclick="aceitarEntregador({{$pedido->id}}, {{$pedido->id_usuario}});">
                        Aceitar entregador
                    </button> <br/> 
                @else
                    <br/>
                @endif
            @endforeach
        @endif
        <!-- FIM LISTA -->
        @endif
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
var aceitarEntregador = function(pedido, entregador){
     $.ajax({
        type: "POST",
        url: "{{ url('pedido/entrega') }}",
        data: {_token:'{{ csrf_token() }}', id_pedido:pedido, id_entregador:entregador },
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
    $('#bt_cancelar').on('click', function(event){
        event.preventDefault();
        console.log("fomfom");
        $.ajax({
            type: "GET",
            url: "{{ url('deletepedido/') . '/' . $pedido->id}}",
            success: function(response){
                console.log("SUCESSO DELETAR: ", response);
                setTimeout(location.reload(), 50);
            },
            error: function(error){
                console.log("ERRO DELETAR: ", error);
                console.log(data);
            }
        });
    });
});
</script>

@endsection