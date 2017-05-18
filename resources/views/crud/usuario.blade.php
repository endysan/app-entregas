@extends ('crud.master')

@section('title', 'Usuarios')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content')

   <div class="container-fluid" style="background-color: white;">
    <h3>Usuarios</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Entregador</th>
            <th></th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ Carbon\Carbon::parse($user->dt_nasc)->format('d/m/Y') }}</td>
            <td>{{ $user->estado }}</td>
            <td>{{ $user->cidade }}</td>
            <td>{{ $user->bairro }}</td>
            <td>{{ $user->id_entregador }}</td>
            <td>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button class="btn btn-success" type="button"
                    data-toggle="modal" data-target="#modalEditar" onclick="editId = {{ $user->id }}; 
                    getById(editId);">
                    Editar
                </button>

                <button class="btn btn-danger" type="button"
                data-toggle="modal" data-target="#modalDeletar" onclick="deleteId = {{ $user->id}}">
                    Excluir
                </button>
            </td>
        </tr>
        @endforeach

    </table>
    @section('modal-cadastrar')
        <form id="form-cadastrar" class="form-crud" method="POST" action="create-usuario">
            
            <input type="hidden" name="edId">
            <div class="form-group">
                <input type="text" class="form-control" name="nome" placeholder="Nome" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <input type="text" id="dt_nasc" name="dt_nasc" class="form-control" 
                placeholder="Data de nascimento" maxlength="10">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form id="form-editar" class="form-crud" method="POST" action="edit-usuario">
            
            <input type="hidden" id="edId" name="id">
            <div class="form-group">
                <input type="text" id="edNome" class="form-control" name="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <input type="email" id="edEmail" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" id="edDt_nasc" name="dt_nasc" class="form-control"  placeholder="Data de nascimento" 
                maxlength="10">
            </div>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn_editar" type="submit" class="btn btn-success">Editar</button>
            
        </form>
    @endsection

    @section('modal-deletar')
        <h4>Você tem certeza que deseja excluir esse registro?</h4>
        <h5>Essa ação é irreversível</h5>
    @endsection
        
</div> <!--CONTAINER-->

    @section('scripts')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" async integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    var deleteId = null;
    var editId = null;

    $(document).ready(function(){
        $('#dt_nasc, #edDt_nasc').mask('00/00/0000');

        $('#form-editar').on('submit', function(event){
            var user = $('#form-editar').serialize();
            $.ajax({
                type: 'PUT',
                url: 'edit-usuario/'+editId,
                data: user,
                success: function(response){
                    console.log(response);
                    console.log(user);

                    setTimeout(location.reload(), 50);
                },
                error: function (response){
                    console.log("ERROR");
                    console.log(response);
                    console.log(user);
                }
            });
            event.preventDefault();
        });

        $('#btn_delete').on('click', function(event){
            $.ajax({
                type: "DELETE",
                url: 'delete-usuario/'+deleteId,
                success: function(response){
                    console.log("SUCESSO");
                    console.log(response);

                    setTimeout(location.reload(), 50);
                },
                error: function(response){
                    console.log("ERRO");
                    console.log(response);
                }
            });
        });
    });

    function clearEditText()
    {
        document.querySelector('#edNome').value = null;
        document.querySelector('#edEmail').value = null;
        document.querySelector('#edDt_nasc').value = null;
    }

    function getById(id)
    {
        clearEditText();
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if(xhttp.readyState == 4 && xhttp.status == 200) {
                var dados = JSON.parse(xhttp.responseText);
                document.querySelector('#edNome').value = dados.name;
                document.querySelector('#edEmail').value = dados.email;
                document.querySelector('#edDt_nasc').value = dados.dt_nasc;
                document.querySelector('#edId').value = id;
                console.log(dados);
            }
            else {
                console.log("Resposta ainda não chegou ou houve um erro");
            }
        }
        xhttp.open('get', 'get-usuario/'+id, true);
        xhttp.send();    
    }
    </script>

    @endsection

@endsection