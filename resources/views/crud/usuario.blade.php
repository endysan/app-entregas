@extends ('crud.master')

@section('title', 'Usuarios')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content')
<script>

    var deleteId = null;
    var editId = null;

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
        xhttp.open('get', 'get-usuario/'+id, true);
        xhttp.send();    
    }
    function editById(id)
    {
        var token = document.querySelector("#token_editar").getAttribute('content');
        var xhttp = new XMLHttpRequest();
        
        var data = {
            name : document.querySelector('#edNome').value,
            email : document.querySelector('#edEmail').value,
            dt_nasc : document.querySelector('#edDt_nasc').value,
            estado : document.querySelector('#edEstado').value,
            cidade : document.querySelector('#edCidade').value,
            bairro : document.querySelector('#edBairro').value
        }
        xhttp.onload = function(){
            if(xhttp.readyState == 4) {
                console.log("provavelmente editou");
                console.log(xhttp);
            }
        };
        xhttp.open("put", 'edit-usuario/'+id, true);
        xhttp.setRequestHeader("CSRF-TOKEN", token);
        xhttp.send(data);
    }
    function deleteById(id)
    {
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function(){
            if(xhttp.readyState == 4) {
                console.log("provavelmente deletou");
                console.log(xhttp);
            }
        };
        xhttp.open("delete", 'delete-usuario/'+id, true);
        xhttp.send(null);
    }
</script>

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
            <td>{{ $user->dt_nasc }}</td>
            <td>{{ $user->estado }}</td>
            <td>{{ $user->cidade }}</td>
            <td>{{ $user->bairro }}</td>
            <td></td>
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
    @section('modal-cadastro')
        <form class="form-crud" method="POST" action="create-usuario">
            <input type="hidden" id="token_cadastrar" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="edId">
            <div class="form-group">
                <input type="text" class="form-control" name="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="senha" placeholder="Senha">
            </div>
            <div class="form-group">
                <input type="text" name="dt_nasc" class="form-control"  placeholder="Data de nascimento" 
                maxlength="10" onkeyup="var v = this.value;
                    if (v.match(/^\d{2}$/) !== null) {
                        this.value = v + '/';
                    } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                        this.value = v + '/';
                    }">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="estado" placeholder="Estado">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cidade" placeholder="Cidade">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="bairro" placeholder="Bairro">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form class="form-crud" method="POST" action="edit-usuario">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="token_editar" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="edId" name="id">
            <div class="form-group">
                <input type="text" id="edNome" class="form-control" name="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <input type="email" id="edEmail" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" id="edDt_nasc" name="dt_nasc" class="form-control"  placeholder="Data de nascimento" 
                maxlength="10" onkeyup="var v = this.value;
                    if (v.match(/^\d{2}$/) !== null) {
                        this.value = v + '/';
                    } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                        this.value = v + '/';
                    }">
            </div>
            <div class="form-group">
                <input type="text" id="edEstado" class="form-control" name="estado" placeholder="Estado">
            </div>
            <div class="form-group">
                <input type="text" id="edCidade" class="form-control" name="cidade" placeholder="Cidade">
            </div>
            <div class="form-group">
                <input type="text" id="edBairro" class="form-control" name="bairro" placeholder="Bairro">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="editById(editId)">Editar</button>
            
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
    @endsection

@endsection