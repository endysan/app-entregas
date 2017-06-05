@extends ('layouts.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="css/editar.css">
@endsection


@section('content')

</script>
    <div class="container-cadastro">

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
            <li>
                <a class="_barra" href="areaentregador">Área do entregador</a>
            </li>
        </ul>

        <form method="POST" action="editar">
            {{ csrf_field() }}
            <div class="form-group">
                <aside>
                    <label for="name" class="form-label">Nome</label>
                </aside>

                <div>
                    <input id="name" name="name" class="form-item" type="text"
                     placeholder="João da Silva" maxlength="100"
                     value="{{Auth::user()->name}}">
                </div>
            </div>
            
            <div class="form-group">
                <aside>
                    <label for="dt_nasc" class="form-label">Data de Nascimento</label>
                </aside>

                <div>
                    <input id="dt_nasc" type="text" name="dt_nasc" placeholder="dd/mm/yyyy" 
                     value="{{ Carbon\Carbon::parse(Auth::user()->dt_nasc)->format('d/m/Y') }}" maxlength="10">
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="telefone" class="form-label">Telefone</label>
                </aside>
                
                <div>
                    <input id="telefone" name="telefone" class="form-item" type="text" 
                     placeholder="(00) 0000-0000" maxlength="14"
                     value="{{ Auth::user()->telefone }}">
                </div>
            </div>

            <div class="form-group">
                <aside>
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                </aside>
                
                <div>
                    <input id="whatsapp" name="whatsapp" class="form-item"  type="text"
                     placeholder="(00) 00000-0000" maxlength="15"
                     value="{{ Auth::user()->whatsapp }}">
                </div>
            </div>

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Salvar</button>
        </div>
    </form>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#dt_nasc').mask('00/00/0000');
            $('#telefone').mask('(00) 0000-0000');
            $('#whatsapp').mask('(00) 00000-0000');
        });
    </script>
@endsection