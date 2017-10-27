@extends ('template.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="{{ url('css/editar.css') }}">
@endsection


@section('content')

<div class="container-editar mx-2 my-4">

    <ul id="side_list" class="lista">
        <li>
            <a class="_barra is-active" href="editar">Editar perfil</a>
        </li>
        <li>
            <a class="_barra" href="editarsenha">Alterar senha</a>
        </li>
        <li>
            <a class="_barra" href="editarendereco">Editar endereço</a>
        </li>
        <li>
            <a class="_barra" href="areaentregador">Área do entregador</a>
        </li>
    </ul>

    <form method="POST" action="editar" class="ml-5">
        {{ csrf_field() }}
        <div class="form-group">
            <aside>
                <label for="nome" class="form-label">Nome</label>
            </aside>

            <div>
                <input id="nome" name="nome" class="form-control" type="text"
                    placeholder="João da Silva"
                    value="{{Auth::user()->nome}}">
            </div>
        </div>

        <div class="form-group">
            <aside>
                <label for="email" class="form-label">email</label>
            </aside>

            <div>
                <input id="email" name="email" class="form-control" type="text"
                    placeholder="joao@email.com"
                    value="{{Auth::user()->email}}" disabled>
            </div>
        </div>
        <div class="form-group">
            <aside>
                <label for="telefone" class="form-label">
                    <i class="fa fa-phone fa-fw"></i>Telefone
                </label>
            </aside>
            
            <div>
                <input id="telefone" name="telefone" class="form-control" type="text" 
                    placeholder="(00) 0000-0000" maxlength="14"
                    value="{{ Auth::user()->telefone }}">
            </div>
        </div>

        <div class="form-group">
            <aside>
                <label for="whatsapp" class="form-label">
                    <i class="fa fa-whatsapp fa-fw"></i>WhatsApp
                </label>
            </aside>
            
            <div>
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