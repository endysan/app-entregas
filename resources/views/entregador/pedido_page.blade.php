@extends('template.master')

@section('title')
Sofá de 2 lugares
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('css/list-pedido.css') }}">
<link rel="stylesheet" href="{{ url('css/plugin/jquery-ui.min.css') }}">
<style>
.input-group-addon {
    background-color: white;
    font-size: 28px;
}
.valor_div {
    width: 30%;
}
.valor_div input {
    font-size: 24px;
    color: #444;
}
</style>
@endsection

@section('content')
<div class="pedido-container">
    <div class="row">
        <!-- IMAGEM PEDIDO -->
        <div class="col-md-4 col-12">
            <img src="{{ url('img/sofa.jpg') }}" alt="" style="max-width: 400px">
        </div>    
        <!-- FIM IMG PEDIDO -->

        <div class="col-md-4 col-12 pt-4">
            <div class="d-flex align-items-center">
                <h1 class="titulo pt-1">Sofá de 2 lugares</h1>
                <span title="Cancelar pedido" id="cancelar" onclick="" class="ml-4" style="cursor:pointer">
                    <i class="fa fa-trash fa-lg"></i>
                </span>
                <div id="dialog-confirm" style="display: none" title="Empty the recycle bin?">
                    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Deseja realmente cancelar o seu pedido?</p>
                </div>
            </div>
            <p class="data-coleta text-muted">Data de coleta: 21/11/2017</p>
            <!-- <img src="" alt="Imagem do produto"/> -->
            <div class="description-area">
                <p style="font-size: 18px">Sofá de couro, cuidado ao transportar</p>
                <p class="text-muted">Período de coleta: <span class="text-dark">Dia todo entre 8:00 e 18:00</span></p>
            </div>
            <div class="contact-area">
                <p class="text-muted">Contato:</p>
                <p><i class="fa fa-whatsapp fa-lg fa-fw" style="color: #01C501"></i>(13) 99999-8888</p>
                <p><i class="fa fa-phone fa-lg fa-fw"></i>Não possui</p>
            </div>
            <div class="address-area">
                <div class="row">
                    <div class="col-6">
                        <p class="text-muted">Informação de entrega:</p>
                        <p title="Origem"><i class="fa fa-map-marker fa-fw mr-2"></i>Itaóca, Mongaguá, SP</p>
                        <p title="Destino"><i class="fa fa-flag fa-fw mr-2"></i>Boqueirão, Santos, SP</p>
                        <p>Distância: 59km</p>
                        <button id="btn_orcamento" class="btn btn-success btn-lg">Enviar orçamento</button>
                        
                        <div id="dialog-orcamento" style="display: none" title="Cancelar este pedido?">
                            <h2 class="titulo"></h2>
                            <form action="{{ url('entregador/pedido/criar-orcamento') }}" method="POST">
                                <div class="align-items-center mt-4">
                                    <div class="col-auto valor_div" style="width: 70%;">
                                        <label class="sr-only" for="valor">Username</label>
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R$</div>
                                                <input type="text" class="form-control" id="valor" placeholder="00,00">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mt-4">
                                        <button type="submit" class="btn btn-success">Enviar proposta</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- FIM DIALOG ORÇAMENTO-->
                    <div class="col-6">
                        <p class="text-muted">Tipo de veículo:</p>
                        <div class="ml-2" style="color: #333;">
                            <i class="fa fa-truck fa-lg ml-2" style="font-size: 38px"></i>
                            <p>Caminhão</p>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
        
        <div class="col-md-4 col-12 pt-4 border-appentrega"> <!-- RESPONSAVEL PELA ENTREGA -->
            
            <div class="orçamento_info d-flex flex-column">
                <h2 class="titulo">Responsável pela entrega</h2>
                @if(!isset($entrega))
                <!-- <p class="status_pendente text-muted mt-4">Aguardando orçamentos</p> -->
                <div class="entregador_proposta">
                    <p><strong>Wenndy Sandy</strong><i class="fa fa-external-link pl-1" style="font-size: 12px"></i></p>
                    <img class="border-rounded" src="{{ url('img/user_icon.png') }}" alt="">
                    <div class="classificacao">
                        <!-- codigo -->
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                </div>
                <p class="proposta_valor">R$36</p>
                <button id="btn_entrega" style="cursor: pointer" class="btn btn-primary">Entrega realizada</button>

                <div id="dialog-avaliacao" style="display: none" title="Cancelar este pedido?">
                    <form id="form-avaliacao" action="" method="POST">
                        {{ csrf_field() }}
                        <h2 class="titulo">Classifique o entregador</h2>
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
            
        </div> <!-- FIM RESPONSAVEL PELA ENTREGA -->

    </div> <!-- PEDIDO CONTAINER -->
    <h3 class="titulo mt-4">Orçamentos propostos</h3>
    <div id="propostas_section" class="p-2 ml-4">
        <div class="row">
            <div class="col-4">
                <div class="entregador_proposta">
                    <p><strong>Marcelo Henrique</strong><i class="fa fa-external-link pl-1" style="font-size: 12px"></i></p>
                    <img class="border-rounded" src="{{ url('img/user_icon.png') }}" alt="">
                    <div class="classificacao">
                        <!-- codigo -->
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                </div>
                <p class="proposta_valor">R$40</p>
            </div>
        </div>
        
    </div> <!-- #proposta_section -->
        <!-- 
                <p class="status_aceito">Entregador e orçamento combinados</p>
                <p>Entregador responsável: <strong></strong></p>
                <p>Valor combinado: <strong></strong></p>
        --> 
        
    </div> <!-- PEDIDO CONTAINER -->
@endsection

@section('script')
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
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
    $('#valor').mask('000.000.000.000.000,00', {reverse: true});

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

    $('#btn_orcamento').click(function(){
        console.log('clicado');
        $('#dialog-orcamento').dialog({
            resizable: false,
            modal: true,
            title: "Propor orçamento",
            width: 430
        });
    }); 
    $('#cancelar').click(function(){
        $('#dialog-confirm').dialog({
            resizable: false,
            modal: true,
            title: "Cancelar pedido",
            buttons: {
                "Sim": function(){
                    $(this).dialog('close');
                    alert('cancelado');
                },
                "Não": function(){
                    $(this).dialog('close');
                },
            }

        });
    });
}); // FIM
</script>

@endsection