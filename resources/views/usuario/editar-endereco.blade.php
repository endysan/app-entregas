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
            <a class="_barra is-active" href="editar">Editar perfil</a>
        </li>
        <li>
            <a class="_barra" href="editar/senha">Alterar senha</a>
        </li>
        <li>
            <a class="_barra" href="editar/endereco">Editar endereço</a>
        </li>
    </ul>

    <form method="POST" action="cadastro" >
        {{ csrf_field() }}
        <div class="form-group">
            <aside>
                <label for="name" class="form-label">Estado</label>
            </aside>

            <div class="form-item">
                <input id="name" name="name" class="form-item" type="text">
            </div>
        </div>
            
        <div class="form-group">
            <aside>
                <label for="dt_nasc" class="form-label">Cidade</label>
            </aside>

            <div class="form-item">
                <input id="dt_nasc" name="txt_dt_nasc" type="text">
            </div>
        </div>

        <div class="form-group">
            <aside>
                <label for="telefone" class="form-label">Bairro</label>
            </aside>
            
            <div class="form-item">
                <input id="telefone" name="txt_telefone" class="form-item" type="text">
            </div>
        </div>

        

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Cadastrar</button>
        </div>
    </form>
    </div>
</div>
@endsection
