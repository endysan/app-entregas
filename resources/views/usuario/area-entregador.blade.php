@extends ('layouts.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="css/editar.css">
@endsection


@section('content')
    <div class="container container-cadastro">

        <ul class="lista">
            <li>
                <a class="_barra" href="editar">Editar perfil</a>
            </li>
            <li>
                <a class="_barra" href="editarsenha">Alterar senha</a>
            </li>
            <li>
                <a class="_barra" href="editarendereco">Editar endereço</a>
            </li>
            <li>
                <a class="_barra is-active" href="areaentregador">Área do entregador</a>
            </li>
        </ul>

        <form method="POST" action="areaentregador">
            {{ csrf_field() }}
            <div class="form-group">
                <aside>
                    <label for="name" class="form-label">Nome</label>
                </aside>

                <div>
                    <input id="name" class="form-item" type="text" 
                     value="{{ Auth::user()->name }}" disabled>
                </div>
            </div>
            
            <div class="form-group">
                <aside>
                    <label for="dt_nasc" class="form-label">Data de Nascimento</label>
                </aside>

                <div>
                    <input type="text" class="form-item" maxlength="10"
                     value="{{ Auth::user()->dt_nasc }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="telefone" class="form-label">Telefone</label>
                </aside>
                
                <div>
                    <input id="telefone" class="form-item" type="text" 
                     value="{{ Auth::user()->telefone }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                </aside>
                
                <div>
                    <input id="whatsapp" class="form-item" type="text"
                     value="{{ Auth::user()->whatsapp }}" disabled>
                </div>
            </div>
            
            <div class="form-group">
                <aside>
                    <label for="cnh" class="form-label">CNH</label>
                </aside>
                <div>
                    <input type="file">
                </div>
            </div>

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Salvar</button>
        </div>
    </form>
    </div>
@endsection