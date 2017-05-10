@extends ('layouts.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="css/editar.css">
@endsection


@section('content')
<div class="container-fluid">

    <div class="container-cadastro">

    <ul class="lista">
        <li>
            <a class="_barra" href="editar">Editar perfil</a>
        </li>
        <li>
            <a class="_barra" href="editarsenha">Alterar senha</a>
        </li>
        <li>
            <a class="_barra is-active" href="editarendereco">Editar endereço</a>
        </li>
        <li>
            <a class="_barra" href="areaentregador">Área do entregador</a>
        </li>
    </ul>

    <form method="POST" action="editarendereco" >
        {{ csrf_field() }}
        <div class="form-group">
            <aside>
                <label for="estado" class="form-label">Estado</label>
            </aside>

            <div>
                <input id="estado" name="estado" class="form-item" type="text" 
                 placeholder="Estado"
                 value="{{ Auth::user()->estado }}">
            </div>
        </div>
            
        <div class="form-group">
            <aside>
                <label for="cidade" class="form-label">Cidade</label>
            </aside>

            <div>
                <input id="cidade" name="cidade" type="text"  
                 placeholder="Cidade"
                 value="{{ Auth::user()->cidade }}">
            </div>
        </div>

        <div class="form-group">
            <aside>
                <label for="bairro" class="form-label">Bairro</label>
            </aside>
            
            <div>
                <input id="bairro" name="bairro" class="form-item" type="text" 
                 placeholder="Bairro"
                 value="{{ Auth::user()->bairro }}">
            </div>
        </div>


        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Salvar</button>
        </div>
    </form>
    </div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('success'))
        <div class="alert alert-success">
        <ul>
            <li>{{ session()->get('success') }}</li>
        </ul>
    </div>
    @endif
@endsection

@section('script')
<script>
$(document).ready(function(){
    $.getJSON('js/dados/estados-cidades.json', function (data) {
            var items = [];
            //var options = '<option value="">escolha um estado</option>';	
            var options = '<option selected hidden>Estado</option>';
            $.each(data, function (key, val) {
                options += '<option value="' + val.nome + '">' + val.nome + '</option>';
            });					
            $("#estados, #edEstados").html(options);				
            
            $("#estados, #edEstados").change(function () {				
            
                var options_cidades = '';
                var str = "";					
                
                $("#estados option:selected, #edDstados option:selected").each(function () {
                    str += $(this).text();
                });
                
                $.each(data, function (key, val) {
                    if(val.nome == str) {							
                        $.each(val.cidades, function (key_city, val_city) {
                            options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                        });							
                    }
                });
                $("#cidades, #edCidades").html(options_cidades);
                
            }).change();	
        
        });
});

</script>

@endsection