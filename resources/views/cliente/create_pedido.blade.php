@extends('template.master')

@section('title', 'Criar Pedidos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/pedido.css') }}">
    <link rel="stylesheet" href="{{ url('css/plugin/jquery-ui.min.css') }}">
    <style>
        #btn-criar {
            cursor: pointer;
        }
        #section-form {
            padding: 20px; 
            max-width: 1260px;
            margin: auto;
            background-color: white;
            border: 1px solid rgba(140,140,140,0.4);
        }
    </style>
@endsection

@section('content')
<section id="section-form">
    <div class='pedido'> <h2 class="text-appentrega">Criar um pedido</h2> </div>
    <form class="form" action="{{ url('cliente/pedido/criar') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }} <!-- Obrigatorio para segurança -->
        <fieldset>
            <!-- BOTAR LEGENDA -->
            <p class="text-muted">Detalhes<i class="fa fa-envelope-open-o fa-fw"></i></p>
            <div class="form-group">
                <label for="titulo">O que será transportado?</label>
                <input class="form-control" id="titulo" name="titulo" type="text" placeholder="Titulo do anúncio">
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
                <label for="dt_entrega">Quando será coletado?</label>
                <input class="form-control" id="dt_entrega" name="dt_entrega" type="text" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group col-md-6">
                <label for="periodo_entrega">Quando será coletado?</label>
                <select class="form-control" name="periodo_entrega" id="periodo_entrega">
                    <option value="1">Dia todo entre 8:00 e 18:00</option>
                    <option value="2">Manhã entre 8:00 e 12:00</option>
                    <option value="3">Tarde entre 13:00 e 18:00</option>
                </select>
            </div>
        </div>

        <!-- -->
        <p class="text-muted">Tipo de veículo<i class="fa fa-truck fa-fw"></i></p>
        <div class="form-group">
            <label for="categoria_pedido">Categoria do pedido</label>
            <select class="form-control" name="categoria_pedido" id="categoria_pedido">
                @foreach($categorias as $i => $categoria)
                    <option value="{{ $i+1 }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
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
                    <input type="text" class="form-control" id="numero_origem" name="numero_origem" placeholder="">
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
                    <input type="text" class="form-control" id="numero_destino" name="numero_destino" placeholder="">
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
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script>
$(document).ready(function(){
    //var cep_origem = $('#cep_origem');
    //var cep_destino = $('#cep_destino');
    $.datepicker.setDefaults( $.datepicker.regional[ "pt-br" ] );
    $("#dt_entrega").datepicker({
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

    // $('#dt_entrega').blur(function(){
    //     var reg = new RegExp("^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$");
    //     if(reg.test($(this).val())){
    //         console.log('{v} data valida');
    //         console.log('{v} '+$(this).val());
    //     }
    //     else {
    //         console.log('{f} data invalida');
    //         console.log('{f} '+$(this).val());
    //     }
    // });

    function limpa_formulário_cep(local) {
        // Limpa valores do formulário de cep.
        $("#rua_"+local).val("");
        $("#bairro_"+local).val("");
        $("#cidade_"+local).val("");
        $("#uf_"+local).val("");
    }
    function preenche_cep(local) {
        var cep = $("#cep_"+local).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua_"+local).val("...");
                $("#bairro_"+local).val("...");
                $("#cidade_"+local).val("...");
                $("#uf_"+local).val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua_"+local).val(dados.logradouro);
                        $("#bairro_"+local).val(dados.bairro);
                        $("#cidade_"+local).val(dados.localidade);
                        $("#uf_"+local).val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep(local);
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
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