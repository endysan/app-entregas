<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/main.css">
    @yield('css')

</head>
<body>
    @include('layouts.nav')

    @yield('content')

    <div id="modalCadastro" class="modal fade"> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cadastrar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                @yield('modal-cadastrar')
                </div>
            </div>
        </div>
    </div><!-- MODAL CADASTRO -->

    <div id="modalEditar" class="modal fade"> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield('modal-editar')
            </div>
            </div>
        </div>
    </div><!-- MODAL EDITAR -->

    <div id="modalDeletar" class="modal fade"> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Excluir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
                @yield('modal-deletar')
            </div>
            <div class="modal-footer">
                <button id="deleteButton" type="button" class="btn btn-danger" 
                    onclick="deleteById(deleteId)">
                    Excluir
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">
                    Cancelar
                </button>
            </div>
            </div>
        </div>
    </div><!-- MODAL EXCLUIR --> 

    @include('layouts.footer')
    @yield('scripts')
</body>
</html>