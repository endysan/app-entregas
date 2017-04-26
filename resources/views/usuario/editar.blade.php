@extends ('layouts.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="css/editar.css">
@endsection


@section('content')
    <div class="container container-cadastro">

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

        <form method="POST" action="cadastro">

            <div class="form-group">
                <aside>
                    <label for="name" class="form-label">Nome</label>
                </aside>

                <div>
                    <input id="name" name="name" class="form-item" type="text" value="{{ Auth::user()->name }}">
                </div>
            </div>
            
            <div class="form-group">
                <aside>
                    <label for="dt_nasc" class="form-label">Data de Nascimento</label>
                </aside>

                <div>
                    <input id="dt_nasc" name="txt_dt_nasc" class="form-item" type="text" value="{{ Auth::user()->dt_nasc }}">
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="telefone" class="form-label">Telefone</label>
                </aside>
                
                <div>
                    <input id="telefone" name="txt_telefone" class="form-item" type="text" value="{{ Auth::user()->telefone }}">
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                </aside>
                
                <div>
                    <input id="whatsapp" name="txt_whatsapp" class="form-item"  type="text" value="{{ Auth::user()->whatsapp }}">
                </div>
            </div>

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Cadastrar</button>
        </div>
    </form>
    </div>
@endsection