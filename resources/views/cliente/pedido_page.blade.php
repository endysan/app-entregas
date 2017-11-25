@extends('template.master')

@section('title')
Sofá de 2 lugares
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('css/list-pedido.css') }}">
@endsection

@section('content')
<div class="pedido-container">
    <div class="row">
        <div class="col-md-4 col-12">
            <img src="{{ url('img/sofa.jpg') }}" alt="" style="max-width: 400px">
        </div>    
        <div class="col-md-4 col-12 pt-4">
            <div class="d-flex align-items-center">
                <h1 class="titulo pt-1">Sofá de 2 lugares</h1>
                <span title="Cancelar pedido" class="ml-4" style="cursor:pointer">
                    <i class="fa fa-trash fa-lg"></i>
                </span>
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
                    </div>
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
        
        <div class="col-md-4 col-12 pt-4 border-appentrega">
            <div class="orçamento_info d-flex flex-column">
                <h2 class="titulo">Responsável pela entrega</h2>
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
                <button class="btn btn-primary">Entrega realizada</button>
            </div>
        </div>   

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
                <button class="btn btn-success text-light" onclick="">
                    Aceitar proposta
                </button>
            </div><div class="col-4">
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
                <button class="btn btn-success text-light" onclick="">
                    Aceitar proposta
                </button>
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
});
</script>

@endsection