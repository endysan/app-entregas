@extends('template.master')

@section('title', 'Criar Pedidos')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pedido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugin/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categoria_veiculo.css') }}">
    <style>
        #btn-criar {
            cursor: pointer;
        }
        #section-form {
            padding: 20px; 
            max-width: 1000px;
            margin: auto;
            background-color: white;
            border: 1px solid rgba(140,140,140,0.4);
        }
        .form-group-btn {
            width: 100%;
        }
        .form-group-btn btn {
            width: 100%;
        }
    </style>
@endsection

@section('content')
<section id="section-form">
    <div class='pedido'> <h2 class="titulo text-appentrega">Criar um pedido</h2> </div>
    <form class="form" action="{{ url('cliente/pedido/criar') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }} <!-- Obrigatorio para segurança -->
        <fieldset>
            <!-- BOTAR LEGENDA -->
            <p class="text-muted">Detalhes<i class="fa fa-envelope-open-o fa-fw"></i></p>
            <div class="form-group">
                <label for="titulo">O que será transportado?</label>
                <input class="form-control" id="titulo" name="titulo" type="text" placeholder="Titulo do anúncio" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descreva o que será transportado (opcional)</label>
                <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição" maxlength="255"></textarea>
            </div>

            <div class="form-group">
                <label for="titulo">Imagem do que deseja enviar (opcional)</label><br/>
                <input type="file" id="img" name="img">
            </div>
        </fieldset>

        <p class="text-muted">Horario<i class="fa fa-clock-o fa-fw"></i></p>
        <div class="form-row">
            
            <div class="form-group col-md-6">
                <label for="data_entrega">Data de entrega</label>
                <input class="form-control" id="data_entrega" name="data_entrega" type="text" placeholder="dd/mm/aaaa" required>
            </div>
            <div class="form-group col-md-6">
                <label for="periodo_entrega">Período de entrega</label>
                <select class="form-control" name="periodo_entrega" id="periodo_entrega" required>
                    <option value="dia">Dia todo entre 8:00 e 18:00</option>
                    <option value="manha">Manhã entre 8:00 e 12:00</option>
                    <option value="tarde">Tarde entre 13:00 e 18:00</option>
                </select>
            </div>
        </div>

        <!-- -->
        <p class="text-muted">Tipo de veículo<i class="fa fa-truck fa-fw"></i></p>
        
            <div id="categoria_veiculo_section" class="form-group">
                <label for="radio_moto">
                    <input type="radio" name="categoria_veiculo" value="moto" id="radio_moto" checked>
                    <i class="fa fa-motorcycle fa-lg" style="font-size: 38px"></i>
                    <p>Moto</p>
                </label>
                <label for="radio_carro">
                    <input type="radio" name="categoria_veiculo" value="carro" id="radio_carro">
                    <i class="fa fa-car fa-lg" style="font-size: 38px"></i>
                    <p>Carro</p>
                </label>
                <label for="radio_caminhao">
                    <input type="radio" name="categoria_veiculo" value="caminhao" id="radio_caminhao">
                    <i class="fa fa-truck fa-lg" style="font-size: 38px"></i>
                    <p>Caminhão</p>
                </label>
            </div>
            
        <div class="row d-flex mt-4">
            <hr/>
            <div class="col-12 col-md-5">
                <p class="text-muted">Endereço de Origem</p>
                <div class="form-group">
                    <label for="cep_origem" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep_origem" name="cep_origem" placeholder="00000-000" required>
                </div>
                <div class="form-group">
                    <label for="rua_origem" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="rua_origem" name="rua_origem" placeholder="" required>
                    <label for="numero_origem" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero_origem" name="numero_origem" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="bairro_origem" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro_origem" name="bairro_origem" placeholder="Bairro" required>
                </div>
                <div class="form-group">
                    <label for="cidade_origem" class="form-label">Cidade</label>
                    <!-- <select name="cidade_origem" id="cidades_origem" class="form-control" required>
                    </select> -->
                    <input type="text" id="cidade_origem" class="form-control" name="cidade_origem" required>
                </div>
                <div class="form-group">
                    <label for="uf_origem" class="form-label">Estado</label>
                    <!-- <select name="estado_origem" id="estados_origem" class="form-control" required>
                    </select> -->
                    <input type="text" id="uf_origem" class="form-control" name="uf_origem" required>
                </div>
            </div>

            <div class="col-md-1 my-auto"><i class="fa fa-arrow-right fa-lg"></i></div>
            <div class="col-12 col-md-6">
            <p class="text-muted">Endereço de Destino</p>
                <div class="form-group">
                    <label for="cep_destino" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep_destino" name="cep_destino" placeholder="00000-000" required>
                </div>
                <div class="form-group">
                    <label for="rua_destino" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="rua_destino" name="rua_destino" placeholder="" required>
                    <label for="numero_destino" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero_destino" name="numero_destino" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="bairro_destino" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro_destino" name="bairro_destino" placeholder="Bairro" required>
                </div>
                <div class="form-group">
                    <label for="cidade_destino" class="form-label">Cidade</label>
                    <!-- <select name="cidade_destino" id="cidades_destino" class="form-control" required>
                    </select> -->
                    <input type="text" id="cidade_destino" class="form-control" name="cidade_destino">
                </div>
                <div class="form-group">
                    <label for="estado_destino" class="form-label">Estado</label>
                    <!-- <select name="estado_destino" id="estados_destino" class="form-control" required>
                    </select> -->
                    <input type="text" id="uf_destino" class="form-control" name="uf_destino">
                </div>
            </div>
            <div class="form-group-btn">
                <button id="btn-criar" class="btn btn-default bg-appentrega text-light" type="submit">Criar Pedido</button>
            </div>
            @if(session()->has('errorMessage'))
                <p style="color: red;">{{ session()->get('errorMessage') }}</p>
            @endif
        </div>

    </form>

</div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/cep.js') }}"></script>
<script>
$(document).ready(function(){
    //var cep_origem = $('#cep_origem');
    //var cep_destino = $('#cep_destino');
    $.datepicker.setDefaults( $.datepicker.regional[ "pt-br" ] );
    $("#data_entrega").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Proximo',
        prevText: 'Anterior'
    });

    $("#cep_origem, #cep_destino").mask('00000-000');

    //Quando o campo cep perde o foco.
    $("#cep_origem").blur(function() {
        preenche_cep("origem");
    });
    $("#cep_destino").blur(function() {
        preenche_cep("destino");
    });
});
</script>

@endsection