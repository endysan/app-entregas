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