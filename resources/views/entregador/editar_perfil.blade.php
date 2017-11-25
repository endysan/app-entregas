@extends ('template.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="{{ url('css/editar.css') }}">
@endsection


@section('content')

<div class="container-editar mx-3 my-4">
    
    <form method="POST" action="editar" class="ml-5">
        {{ csrf_field() }}
        <h1 class="titulo p-2">Informações básicas</h1>
        <div class="form-group">
            <div class="col-4 my-auto">
                <label for="nome" class="form-label">
                    <i class="fa fa-user-o fa-fw"></i>Nome
                </label>
            </div>
            <div class="col-8">
                <input id="nome" name="nome" class="form-control" type="text"
                    placeholder="João da Silva"
                    value="{{Auth::user()->nome}}">
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
                    value="{{Auth::user()->email}}" disabled>
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
                    value="{{ Auth::user()->telefone }}">
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
                    value="{{ Auth::user()->whatsapp }}">
            </div>
        </div>
        <h2 class="titulo">Informações de endereço</h2>
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
        <div class="form-group-btn">
            <button id="btn-cadastro" class="btn btn-default bg-appentrega text-light" type="submit">Salvar</button>
        </div>
    </form>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#telefone').mask('(00) 0000-0000');
            $('#whatsapp').mask('(00) 00000-0000');
        });
    </script>
@endsection