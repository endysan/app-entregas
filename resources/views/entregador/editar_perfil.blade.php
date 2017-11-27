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
        <!-- -->

        <h2 class="titulo">Informações do entregador</h2>
        
        <div class="form-group">
            <div class="col-4 my-auto">
                <label for="cpf" class="form-label">
                    <i class="fa fa-address-card-o fa-fw"></i>CPF
                </label>
            </div>
            <div class="col-8">
                <input id="cpf" name="cpf" class="form-control"  type="text"
                    placeholder="000.000.000-00" maxlength="14"
                    value="{{ Auth::user()->entregador->cpf }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-4 my-auto">
                <label for="cnh" class="form-label">
                    <i class="fa fa-address-book fa-fw"></i>CNH
                </label>
            </div>
            <div class="col-8">
                <input id="cnh" name="cnh" class="form-control"  type="text"
                    placeholder="00000000000" maxlength="11"
                    value="{{ Auth::user()->entregador->cnh }}">
            </div>
        </div>
        <!-- -->
        <h2 class="titulo">Informações de endereço</h2>
            
        <div class="form-group">
            <div class="col-1 my-auto">
                <label for="cep" class="form-label">CEP</label>
            </div>
            <div class="col-11 my-auto">
            <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" required>
            </div>
        </div>
    <div class="form-group">
        <div class="col-1">
            <label for="rua" class="form-label">Rua</label>
        </div>
        <div class="col-6">
            <input type="text" class="form-control" id="rua" name="rua" required>
        </div>
        <div class="col-2">
            <label for="numero" class="form-label">Número</label>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" id="numero" name="numero">
        </div>
    </div>

    <div class="form-group">
        <div class="col-1 my-auto">
            <label for="bairro" class="form-label">Bairro</label>
        </div>
        <div class="col-11 my-auto">
            <input type="text" class="form-control" id="bairro" name="bairro" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-1 my-auto">
            <label for="cidade" class="form-label">Cidade</label>
        </div>
        <!-- <select name="cidade_origem" id="cidades_origem" class="form-control" required>
        </select> -->
        <div class="col-11 my-auto">
            <input type="text" id="cidade" class="form-control" name="cidade" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-1 my-auto">
            <label for="uf" class="form-label">Estado</label>
        </div>
        <!-- <select name="estado_origem" id="estados_origem" class="form-control" required>
        </select> -->
        <div class="col-11 my-auto">
            <input type="text" id="uf" class="form-control" name="uf" required>
        </div>
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
            $('#cpf').mask('(000.000.000-00');
        });
    </script>
@endsection