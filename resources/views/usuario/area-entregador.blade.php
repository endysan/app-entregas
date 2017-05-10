@extends ('layouts.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="css/editar.css">
@endsection


@section('content')
    <div class="container-cadastro">

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
                    <label for="veiculo" class="form-label">Veículo</label>
                </aside>

                <div class="form-group">
                
                    @if($entregador == null)
                    <select name="veiculo" id="veiculo" class="form-item" required>
                        <option selected hidden value="">Escolha</option>
                        <option value="carro">Carro</option>
                        <option value="caminhao">Caminhão</option>
                        <option value="moto">Moto</option>
                    </select>
                    @else 
                    <input type="text" class="form-item"
                        value="{{ ucwords($entregador->veiculo) }}" disabled>
                    @endif
                </div>
            </div>
            
            <div class="form-group">
                @if($entregador != null)
                <aside>
                    <label for="cnh" class="form-label">CNH</label>
                </aside>
                <div>
                    <input type="text" class="form-item" maxlength="10"
                     value="{{ $entregador->cnh }}" disabled>
                </div>
                @endif
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
            
            @if($entregador == null || $entregador->cnh == null)
            <div class="form-group">
                <aside>
                    <label for="cnh" class="form-label">CNH</label>
                </aside>
                <div>
                    <input type="text" class="form-item" name="cnh" placeholder="CNH" maxlength="10" required>
                </div>
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Salvar</button>
        </div>
    </form>
    </div>

    @section('script')
    <script>
        $(document).ready(function(){
            $('#dt_nasc').mask('00/00/0000');
        });
    </script>
    @endsection
@endsection