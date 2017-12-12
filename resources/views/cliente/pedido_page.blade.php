@extends('template.master')

@section('title')
    {{ $pedido->titulo }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/list-pedido.css') }}">
<link rel="stylesheet" href="{{ asset('css/plugin/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/ratings.css') }}">
@endsection

@section('content')
<div class="pedido-container">
    <div class="row">
        <div class="col-md-4 col-12">
            <img src="{{ asset('storage/pedido/' . $pedido->img_pedido) }}" style="max-width: 400px">
        </div>    
        <div class="col-md-4 col-12 pt-4">
            <div class="d-flex align-items-center">
                <h1 class="titulo pt-1">{{ $pedido->titulo }}</h1>
                <span title="Cancelar pedido" id="cancelar" onclick="" class="ml-4" style="cursor:pointer">
                    <i class="fa fa-trash fa-lg"></i>
                </span>
                <div id="dialog-confirm" style="display: none" title="Cancelar este pedido?">
                    <form method="POST" action="">
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <p>Motivo de cancelamento</p>
                        <div class="form-check">
                            <label class="form-check-label" for="">
                                <input class="form-check-input" type="radio">Informações do pedido estão incorretas
                            </label>
                        </div>
                        <div>
                            <label class="form-check-label" for="">
                                <input class="form-check-input" type="radio">Problemas com o entregador
                            </label>
                        </div>
                        <div>
                            <label class="form-check-label" for="">
                                <input class="form-check-input" type="radio">Extravio
                            </label>
                        </div>
                        <div>
                            <label class="form-check-label" for="">
                                <input class="form-check-input" type="radio">Outros
                            </label>
                        </div>
                    </form>
                    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Deseja realmente cancelar o seu pedido?</p>
                </div>
            </div>
            <p class="data-coleta text-muted">Data de entrega: {{ Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y') }}</p>
            <!-- <img src="" alt="Imagem do produto"/> -->
            <div class="description-area">
                <p style="font-size: 18px">{{ $pedido->descricao }}</p>
                <p class="text-muted">Período de entrega: <span class="text-dark">{{ App\Pedido::periodoEntrega($pedido->periodo_entrega) }}</span></p>
            </div>
            <div class="contact-area">
                <p class="text-muted">Contato:</p>
                <p><i class="fa fa-whatsapp fa-lg fa-fw" style="color: #01C501"></i>{{ isset($pedido->cliente->whatsapp) ? $pedido->cliente->whatsapp : "Não possui" }}</p>
                <p><i class="fa fa-phone fa-lg fa-fw"></i>{{ isset($pedido->cliente->telefone) ? $pedido->cliente->telefone : "Não possui" }}</p>
            </div>
            <div class="address-area">
                <div class="row">
                    <div class="col-6">
                        <p class="text-muted">Informação de entrega:</p>
                        <p title="Origem"><i class="fa fa-map-marker fa-fw mr-2"></i>{{ ucfirst($pedido->bairro_origem) . ', '. ucfirst($pedido->cidade_origem) . ', '. ucfirst($pedido->estado_origem) }}</p>
                        <p title="Destino"><i class="fa fa-flag fa-fw mr-2"></i>{{ ucfirst($pedido->bairro_destino) . ', '. ucfirst($pedido->cidade_destino) . ', '. ucfirst($pedido->estado_destino) }}</p>
                        <p>Distância: {{ "" }}</p>
                    </div>
                    <div class="col-6">
                        <p class="text-muted">Tipo de veículo:</p>
                        <div class="ml-2" style="color: #333;">
                            @if($pedido->categoria_veiculo == 'moto')
                                <i class="fa fa-motorcycle fa-lg ml-2" style="font-size: 38px"></i>
                                <p class="ml-2">Moto</p>
                            @elseif($pedido->categoria_veiculo == 'carro')
                                <i class="fa fa-car fa-lg ml-2" style="font-size: 38px"></i>
                                <p class="ml-2">Carro</p>
                            @elseif($pedido->categoria_veiculo == 'caminhao')
                                <i class="fa fa-truck fa-lg ml-2" style="font-size: 38px"></i>
                                <p class="ml-2">Caminhão</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
        
        <div class="col-md-4 col-12 pt-4 border-appentrega">
            
            <div class="orçamento_info d-flex flex-column">
                <h2 class="titulo">Responsável pela entrega</h2>
                <!-- <p class="status_pendente text-muted mt-4">Aguardando orçamentos</p> -->
               @if(!empty($entrega))
                <div class="entregador_proposta">
                    <p>
                        <a href="{{ url('perfil/id=' . $entrega->proposta->entregador->cliente->id) }}">
                        <strong>{{ $entrega->proposta->entregador->cliente->nome }}</strong><i class="fa fa-external-link pl-1" style="font-size: 12px"></i></a>
                    </p>
                    <img class="border-rounded" src="{{ url('img/user_icon.png') }}" alt="">
                    <div class="classificacao">
                        <!-- codigo -->
                                           
                    </div>
                </div>
                <p class="proposta_valor">R${{ str_replace('.', ',', $proposta->valor_proposta) }}</p>
                <button id="btn_entrega" style="cursor: pointer" class="btn btn-primary">Entrega realizada</button>

                <div id="dialog-avaliacao" style="display: none" title="Cancelar este pedido?">
                    <form id="form-avaliacao" action="" method="POST">
                        {{ csrf_field() }}
                        <h2 class="titulo">Classifique o entregador</h2>
                        <input type="hidden" name="entregador_id" value="{{ $entrega->proposta->entregador->id }}" />
                        <div class="estrelas">
                            <input type="radio" name="estrela" value="" checked>

                            <label for="estrela_um"><i class="fa"></i></label>
                            <input id="estrela_um" type="radio" name="estrela" value="1">
                            
                            <label for="estrela_dois"><i class="fa"></i></label>
                            <input id="estrela_dois" type="radio" name="estrela" value="2">

                            <label for="estrela_tres"><i class="fa"></i></label>
                            <input id="estrela_tres" type="radio" name="estrela" value="3">

                            <label for="estrela_quatro"><i class="fa"></i></label>
                            <input id="estrela_quatro" type="radio" name="estrela" value="4">

                            <label for="estrela_cinco"><i class="fa"></i></label>
                            <input id="estrela_cinco" type="radio" name="estrela" value="5">
                        </div>
                    </form>
                </div>
                @else
                <div class="my-5" style="color: rgb(140,140,140); text-align:center; font-size: 16px;">
                    <p>Esse pedido ainda não possui um entregador</p>
                </div>

            @endif
            </div>
            
        </div>   

    </div> <!-- PEDIDO CONTAINER -->

    <!-- SE JA FOI ACEITO, NÃO LISTA OS ORÇAMENTOS -->
    @if(empty($entrega))
    <h3 class="titulo mt-4">Orçamentos propostos</h3>
    <div id="propostas_section" class="p-2 ml-4">
        <div class="row">
        @if(!isset($propostas) || empty($propostas))
            <p style="color: rgb(140,140,140)">Ainda não foram propostos orçamentos para esse pedido </p>
        @else
            @foreach($propostas as $proposta)
            <div class="col-4">
                <div class="entregador_proposta">
                    
                    <p>
                        <a href="{{ url('perfil/id=' . $proposta->entregador->id) }}">
                        <strong>{{ $proposta->entregador->cliente->nome }}</strong>
                        <i class="fa fa-external-link pl-1" style="font-size: 12px"></i></a>
                    </p>
                    <img class="border-rounded" src="{{ url('img/user_icon.png') }}" alt="">
                    <div class="classificacao">
                                                
                    </div>
                </div>
                <p class="proposta_valor">R${{ str_replace('.', ',', $proposta->valor_proposta) }}</p>
                <form action="{{ url('cliente/pedido/aceitar-orcamento') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <input type="hidden" name="proposta_id" value="{{ $proposta->id }}">
                    <button class="btn btn-success text-light" type="submit">
                        Aceitar proposta
                    </button>
                </form>
                
            </div>
            @endforeach
        @endif<!-- IF !empty(Proposta) -->
    </div> <!-- #proposta_section -->
    @endif <!-- IF empty(Entrega)-->
        <!-- 
                <p class="status_aceito">Entregador e orçamento combinados</p>
                <p>Entregador responsável: <strong></strong></p>
                <p>Valor combinado: <strong></strong></p>
        --> 
        
    </div> <!-- PEDIDO CONTAINER -->
@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script>

var aceitarEntregador = function(pedido, entregador){
     $.ajax({
        type: "POST",
        url: "{{ url('pedido/entrega') }}",
        data: { _token:'{{ csrf_token() }}', id_pedido:pedido, id_entregador:entregador },
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
            url: "{{ url('deletepedido/') . '/'}}",
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

    $('#cancelar').click(function(){
        $('#dialog-confirm').dialog({
            resizable: false,
            modal: true,
            title: "Cancelar pedido",
            buttons: {
                "Sim": function(){
                    $(this).dialog('close')
                    alert('cancelado');
                },
                "Não": function(){
                    $(this).dialog('close')
                },
            }

        });
    });

    $('#btn_entrega').click(function(){
        $('#dialog-avaliacao').dialog({
            resizable: false,
            modal: true,
            width: 500,
            title: "Avaliar entregador",
            buttons: {
                "Enviar": function(){
                    console.log("sim");
                    $(this).dialog('close')
                    $('#form-avaliacao').submit();
                },
                "Cancelar": function(){
                    console.log("nao");
                    $(this).dialog('close')
                },
            }
        });
    });

}); // FIM
</script>
@endsection