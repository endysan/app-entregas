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
.distancia{
    font-weight: 600;
}
</style>
@endsection

@section('content')
<div class="pedido-container">
    <div class="row">
        <!-- IMAGEM PEDIDO -->
        <div class="col-md-4 col-12">
             @if($pedido->img != null)
            <img src="{{ asset('storage/pedido/' . $pedido->img_pedido) }}" style="max-width: 100%">
            @else
            <img src="{{ asset('storage/pedido/produto-sem-imagem.gif') }}" style="max-width: 100%">
            @endif
        </div>    
        <!-- FIM IMG PEDIDO -->

        <div class="col-md-4 col-12 pt-4">
            <div class="d-flex align-items-center">
                <h1 class="titulo pt-1">{{ $pedido->titulo }}</h1>
                <span title="Cancelar pedido" id="cancelar" onclick="" class="ml-4" style="cursor:pointer">
                    <i class="fa fa-trash fa-lg"></i>
                </span>
                <div id="dialog-confirm" style="display: none" title="Empty the recycle bin?">
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
                        
                        <p>Distância até o cliente: <span class="distancia" id="distancia-1"></span></p>
                        <p>Deslocamento do pedido: <span class="distancia" id="distancia-2"></span></p>

                        <button id="btn_orcamento" class="btn btn-success btn-lg">Enviar orçamento</button>
                        
                        <div id="dialog-orcamento" style="display: none" title="Cancelar este pedido?">
                            <h2 class="titulo"></h2>
                            <form action="{{ url('entregador/pedido/proposta') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                <input type="hidden" name="entregador_id" value="{{ auth()->user()->entregador->id }}">
                                <div class="align-items-center mt-4">
                                    <div class="col-auto valor_div" style="width: 70%;">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R$</div>
                                                <input type="text" class="form-control" id="valor" name="valor" placeholder="00,00">
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
        
        <div class="col-md-4 col-12 pt-4 border-appentrega"> <!-- RESPONSAVEL PELA ENTREGA -->
            
            <div class="orçamento_info d-flex flex-column">
                <h2 class="titulo">Responsável pela entrega</h2>
                @if(!empty($entrega))
                <!-- <p class="status_pendente text-muted mt-4">Aguardando orçamentos</p> -->
                <div class="entregador_proposta">
                    <p>
                        <a href="{{ url('perfil/id=' . $entrega->proposta->entregador->cliente->id) }}">
                        <strong>{{ $entrega->proposta->entregador->cliente->nome }}</strong><i class="fa fa-external-link pl-1" style="font-size: 12px"></i></a>
                    </p>
                      @if($entrega->proposta->entregador->cliente->img_perfil == null)
                        <img src="{{ asset('storage/avatar/user_icon.png') }}">
                    @else
                        <img src="{{ asset('storage/avatar/' . $entrega->proposta->entregador->cliente->img_perfil) }}" class="border-rounded">
                    @endif
                    <div class="classificacao">
                        <!-- codigo -->
                        <?php $class = new App\Http\Controllers\ClienteController();
                       
                        $value = $class->getClassificacao($entrega->proposta->entregador->id);
                        $whiteStars = 5 - $value;
                        ?>

                        @for($i = 0; $i < $value; $i++)

                            <i class="fa fa-star"></i>
                        @endfor
                        
                        @for($i = 0; $i < $whiteStars; $i++)
                            <i class="fa fa-star-o"></i>
                        @endfor

                    </div>
                </div>
                <p class="proposta_valor">R${{ str_replace('.', ',', $entrega->proposta->valor_proposta) }}</p>
                @if($entrega->status == 'realizada')
                    <p style="font-weight: 600; color:rgb(10,50,150);">Entrega realizada!</p>
                @endif

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
        @if(count($propostas) == 0)
            <p style="color: rgb(140,140,140)">Ainda não foram propostos orçamentos para esse pedido </p>
        @else
            @foreach($propostas as $proposta)
            <div class="col-4">
                <div class="entregador_proposta">
                    
                    <p>
                        <a href="{{ url('perfil/id=' . $proposta->entregador->cliente->id) }}">
                        <strong>{{ $proposta->entregador->cliente->nome }}</strong>
                        <i class="fa fa-external-link pl-1" style="font-size: 12px"></i></a>
                    </p>
                      @if($proposta->entregador->cliente->img_perfil == null)
                        <img src="{{ asset('storage/avatar/user_icon.png') }}">
                    @else
                        <img src="{{ asset('storage/avatar/' . $proposta->entregador->cliente->img_perfil) }}" class="border-rounded">
                    @endif
                    <div class="classificacao">
                       
                        <?php 
                        $class = new App\Http\Controllers\ClienteController();
                        $value = $class->getClassificacao($proposta->entregador->id);
                        $whiteStars = 5 - $value;
                        ?>
                        @for($i = 0; $i < $value; $i++)

                            <i class="fa fa-star"></i>
                        @endfor
                        
                        @for($i = 0; $i < $whiteStars; $i++)
                            <i class="fa fa-star-o"></i>
                        @endfor
                    </div>
                </div>
                <p class="proposta_valor">R${{ str_replace('.', ',', $proposta->valor_proposta) }}</p>
                
            </div>
            @endforeach
    </div> <!-- #proposta_section -->
    @endif <!-- IF empty(Entrega)-->
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

    @if(auth()->user()->entregador->endereco)
    var origem_1 = "{{ ucfirst($pedido->logradouro_origem) . ', ' . ucfirst($pedido->bairro_origem) . ', '. ucfirst($pedido->cidade_origem) . ', '. ucfirst($pedido->estado_origem) }}";
    var destino_1 = "{{ ucfirst(auth()->user()->entregador->endereco->rua) . ', nº ' . ucfirst(auth()->user()->entregador->endereco->numero) . ', ' . ucfirst(auth()->user()->entregador->endereco->bairro) . ', '. ucfirst(auth()->user()->entregador->endereco->cidade) . ', '. ucfirst(auth()->user()->entregador->endereco->estado) }}";
    $.ajax({
        url: "{{ url('api/distancia') }}" + "/origem="+origem_1+"/destino="+destino_1,
        method: "GET",
        success: function(response){
            var data = JSON.parse(response);
            console.log(data.rows[0].elements[0].distance.text);
                    
            $("#distancia-1").text(data.rows[0].elements[0].distance.text);
        },
        error: function(error){

        }
    });

    @endif  
    

    var origem_2 = "{{ ucfirst($pedido->logradouro_origem) . ', ' . ucfirst($pedido->bairro_origem) . ', '. ucfirst($pedido->cidade_origem) . ', '. ucfirst($pedido->estado_origem) }}";
    var destino_2 = "{{ ucfirst($pedido->logradouro_destino) . ', ' . ucfirst($pedido->bairro_destino) . ', '. ucfirst($pedido->cidade_destino) . ', '. ucfirst($pedido->estado_destino) }}";

    //DISTANCIA
    $.ajax({
        url: "{{ url('api/distancia') }}" + "/origem="+origem_2+"/destino="+destino_2,
        method: "GET",
        success: function(response){
            var data = JSON.parse(response);
            console.log(data.rows[0].elements[0].distance.text);
                    
            $("#distancia-2").text(data.rows[0].elements[0].distance.text);
        },
        error: function(error){

        }
    });

}); // FIM
</script>

@endsection