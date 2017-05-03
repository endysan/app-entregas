@extends ('crud.master')

@section('title', 'entregadors')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content')

   <div class="container-fluid" style="background-color: white;">
    <h3>entregadors</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>ID Usuario</th>
            <th>CNH</th>
            <th>Status</th>
            <th></th>
        </tr>
        @foreach($entregadores as $entregador)
        <tr>
            <td>{{ $entregador->id }}</td>
            <td>{{ $entregador->user_id }}</td>
            <td>{{ $entregador->cnh }}</td>
            <td>{{ $entregador->status }}</td>
            <td>
                <input type="hidden" name="entregador_id" value="{{ $entregador->id }}">
                <button class="btn btn-success" type="button"
                    data-toggle="modal" data-target="#modalEditar" onclick="editId = {{ $entregador->id }}; 
                    getById(editId);">
                    Editar
                </button>

                <button class="btn btn-danger" type="button"
                data-toggle="modal" data-target="#modalDeletar" onclick="deleteId = {{ $entregador->id}}">
                    Excluir
                </button>
            </td>
        </tr>
        @endforeach

    </table>
    @section('modal-cadastrar')
        <form id="form-cadastrar" class="form-crud" method="POST" action="create-entregador">
            
            <input type="hidden" name="edId">
            <div class="form-group">
                <select name="email_id">
                    <option selected>Entregadores</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cnh" placeholder="CNH" maxlenght="10">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form id="form-editar" class="form-crud" method="POST" action="edit-entregador">
            
            <input type="hidden" id="edId" name="id">
            <div class="form-group">
                <input type="text" id="edCnh" class="form-control" name="cnh" placeholder="CNH">
            </div>
            <div class="form-group">
                <select id="edStatus" name="status">
                    <option selected></option>
                    <option value="1">Reprovado</option>
                    <option value="2">Andamento</option>
                    <option value="3">Aprovado</option>
                </select>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" async integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    var deleteId = null;
    var editId = null;

    $(document).ready(function(){
        
        $('#form-editar').on('submit', function(event){
            var entregador = $('#form-editar').serialize();
            $.ajax({
                type: 'PUT',
                url: 'edit-entregador/'+editId,
                data: entregador,
                success: function(response){
                    console.log(response);
                    console.log(entregador);

                    setTimeout(location.reload(), 500);
                },
                error: function (response){
                    console.log("ERROR");
                    console.log(response);
                    console.log(entregador);
                }
            });
            event.preventDefault();
        });

        $('#btn_delete').on('click', function(event){
            $.ajax({
                type: "DELETE",
                url: 'delete-entregador/'+deleteId,
                success: function(response){
                    console.log("SUCESSO");
                    console.log(response);

                    setTimeout(location.reload(), 500);
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
        document.querySelector('#edEstado').value = null;
        document.querySelector('#edCidade').value = null;
        document.querySelector('#edBairro').value = null;
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
                document.querySelector('#edEstado').value = dados.estado;
                document.querySelector('#edCidade').value = dados.cidade;
                document.querySelector('#edBairro').value = dados.bairro;
                document.querySelector('#edId').value = id;
                console.log(dados);
            }
            else {
                console.log("Resposta ainda não chegou ou houve um erro");
            }
        }
        xhttp.open('get', 'get-entregador/'+id, true);
        xhttp.send();    
    }
</script>

    @endsection

@endsection