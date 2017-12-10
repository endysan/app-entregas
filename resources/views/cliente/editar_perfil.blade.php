@extends ('template.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugin/jquery-ui.min.css') }}">
@endsection


@section('content')

<div class="container-editar mx-3 my-4">
    
    <form id="form_editar" method="POST" action="{{ url('cliente/editar') }}" class="ml-5">
        {{ csrf_field() }}
        <h1 class="titulo p-2">Informações básicas</h1>
        <input type="hidden" name="cliente_id" value="{{ auth()->user()->id }}">
        <div class="form-group">
            <div class="col-4 my-auto">
                <label for="nome" class="form-label">
                    <i class="fa fa-user-o fa-fw"></i>Nome
                </label>
            </div>
            <div class="col-8">
                <input id="nome" name="nome" class="form-control" type="text"
                    placeholder="João da Silva"
                    value="{{ auth()->user()->nome }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-4 my-auto">
                <label for="email" class="form-label">
                    <i class="fa fa-envelope-o fa-fw"></i>Email
                </label>
            </div>

            <div class="col-8">
                <input id="email" name="email" class="form-control" type="text"
                    placeholder="joao@email.com"
                    value="{{ auth()->user()->email }}" disabled>
            </div>
        </div>

        <div class="form-group">
             <div class="col-4 my-auto">
                <label for="telefone" class="form-label">
                    <i class="fa fa-phone fa-fw"></i>Telefone
                </label>
            </div>
            
            <div class="col-8">
                <input id="telefone" name="telefone" class="form-control" type="text" 
                    placeholder="(00) 0000-0000" maxlength="14"
                    value="{{ auth()->user()->telefone }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-4 my-auto">
                <label for="whatsapp" class="form-label">
                    <i class="fa fa-whatsapp fa-fw"></i>WhatsApp
                </label>
            </div>
            
            <div class="col-8">
                <input id="whatsapp" name="whatsapp" class="form-control"  type="text"
                    placeholder="(00) 00000-0000" maxlength="15"
                    value="{{ auth()->user()->whatsapp }}">
            </div>
        </div>
        <div id="dialog-confirm" title="Editar informações?" style="display: none">
            <p><span class="fa fa-warning" style="float:left; margin:5px 12px 10px 0;"></span>            Deseja realmente atualizar seus dados?
            </p>
        </div>
        <div class="form-group-btn">
            <button id="btn_editar" style="cursor: pointer" class="btn btn-default bg-appentrega text-light" type="button">Salvar</button>
        </div>
        
    </form>
</div>

@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#telefone').mask('(00) 0000-0000');
        $('#whatsapp').mask('(00) 00000-0000');

        $('#btn_editar').click(function(){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "OK": function() {
                        $('#form_editar').submit();
                    },
                    "Cancelar": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });
    
});
</script>
@endsection