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
                <a class="_barra" href="editarsenha">Alterar senha</a>
            </li>
            <li>
                <a class="_barra" href="editarendereco">Editar endereço</a>
            </li>
        </ul>

        <form method="POST" action="editar">
            {{ csrf_field() }}
            <div class="form-group">
                <aside>
                    <label for="name" class="form-label">Nome</label>
                </aside>

                <div>
                    <input id="name" name="name" class="form-item" type="text" placeholder="{{ Auth::user()->name }}">
                </div>
            </div>
            
            <div class="form-group">
                <aside>
                    <label for="dt_nasc" class="form-label">Data de Nascimento</label>
                </aside>

                <div>
                    <input type="text" name="dt_nasc" placeholder="dd/mm/yyyy" maxlength="10"
                     onkeyup="
                        var v = this.value;
                        if (v.match(/^\d{2}$/) !== null) {
                            this.value = v + '/';
                        } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                            this.value = v + '/';
                        }">
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="telefone" class="form-label">Telefone</label>
                </aside>
                
                <div>
                    <input id="telefone" name="telefone" class="form-item" type="text" placeholder="{{ Auth::user()->telefone }}">
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                </aside>
                
                <div>
                    <input id="whatsapp" name="whatsapp" class="form-item"  type="text" placeholder="{{ Auth::user()->whatsapp }}">
                </div>
            </div>

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Cadastrar</button>
        </div>
    </form>
    </div>
@endsection