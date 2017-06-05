@extends('layouts.master')

@section('title', 'Criar Pedidos')


@section('css')
    <link rel="stylesheet" href="{{ url('css/pedido.css') }}">
@endsection


@section('content')
<div class="container-pedido">
    <div class='pedido'> <h2>Criar um pedido</h2> </div>
    
    <form method="POST" action="pedido">
        {{ csrf_field() }} <!-- Obrigatorio para segurança -->

        <div class="bloco1">
            <p class="muted">Informações do seu produto</p>
            <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}">

            <div class="form-group">
                <label for="produto" class="form-label">Seu produto</label>
                <input id="produto" name="produto" class="form-item" type="text" required>
            </div>

            <div class="form-group">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-item" required></textarea>
            </div>  
        </div>

        <div class="bloco2">
            <hr/>
            <p class="muted">Informações de entrega</p>
            <div class="form-group">
                <label for="estados" class="form-label">Estado</label>
                <select name="estado" id="estados" class="form-item" required>
                </select>
            </div>
            <div class="form-group">
                <label for="cidades" class="form-label">Cidade</label>
                <select name="cidade" id="cidades" class="form-item" required>
                </select>
            </div>
            <div class="form-group">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-item" name="bairro" placeholder="Bairro" required>
            </div>
            <div class="form-group">
                <label for="dt_entrega" class="form-label">Data de entrega</label>
                <input id="dt_entrega" name="dt_entrega" class="form-item" type="text"
                 placeholder="dd/mm/aaaa" maxlength="10" required>
            </div>
        </div>

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Criar Pedido</button>
        </div>

        @if(session()->has('errorMessage'))
            <p style="color: red;">{{ session()->get('errorMessage') }}</p>
        @endif()
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var dt_entrega = $('#dt_entrega');
        dt_entrega.mask('00/00/0000');

        dt_entrega.on('focusout', function(){
            var reg = new RegExp("^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$");
            if(reg.test(dt_entrega.val())){
                console.log('{v} data valida');
                console.log('{v} '+dt_entrega.val());
            }
            else {
                console.log('{f} data invalida');
                console.log('{f} '+dt_entrega.val());
            }

        });
        
        $.getJSON('js/dados/estados-cidades.json', function (data) {
				var items = [];
				//var options = '<option value="">Escolha um estado</option>';	
                var options = '<option selected hidden value="">Estado</option>';
				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#estados").html(options);				
				
				$("#estados").change(function () {				
				
                    var options_cidades = '';
					var str = "";					
					
					$("#estados option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.cidades, function (key_city, val_city) {
								options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});
					$("#cidades").html(options_cidades);
				}).change();	
			});
    });
</script>
@endsection