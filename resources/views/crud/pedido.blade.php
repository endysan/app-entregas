@extends ('crud.master')

@section('title', 'pedidos')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content')

   <div class="container-fluid" style="background-color: white;">
    <h3>pedidos</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Entregador</th>
            <th></th>
        </tr>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->produto }}</td>
            <td>{{ $pedido->descricao }}</td>
            <td>{{ $pedido->estado }}</td>
            <td>{{ $pedido->cidade }}</td>
            <td>{{ $pedido->bairro }}</td>
            <td>
                <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                <button class="btn btn-success" type="button"
                    data-toggle="modal" data-target="#modalEditar" onclick="editId = {{ $pedido->id }}; 
                    getById(editId);">
                    Editar
                </button>

                <button class="btn btn-danger" type="button"
                data-toggle="modal" data-target="#modalDeletar" onclick="deleteId = {{ $pedido->id }}">
                    Excluir
                </button>
            </td>
        </tr>
        @endforeach

    </table>
    @section('modal-cadastrar')
        <form id="form-cadastrar" class="form-crud" method="POST" action="create-pedido">
            
            <input type="hidden" name="edId">
            <div class="form-group">
                <input type="text" class="form-control" name="produto" placeholder="Produto" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="descricao" placeholder="Descrição"></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="estado" placeholder="Estado" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cidade" placeholder="Cidade" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="bairro" placeholder="Bairro" required>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form id="form-editar" class="form-crud" method="POST" action="edit-pedido">
            
            <input type="hidden" id="edId" name="id">
            <div class="form-group">
                <input type="text" id="edProduto" class="form-control" name="produto" placeholder="Produto">
            </div>
            <div class="form-group">
                <textarea id="edDescricao" class="form-control" name="descricao" placeholder="Descrição"></textarea>
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
            var pedido = $('#form-editar').serialize();
            $.ajax({
                type: 'PUT',
                url: 'edit-pedido/'+editId,
                data: pedido,
                success: function(response){
                    console.log(response);
                    console.log(pedido);

                    setTimeout(location.reload(), 500);
                },
                error: function (response){
                    console.log("ERROR");
                    console.log(response);
                    console.log(pedido);
                }
            });
            event.preventDefault();
        });

        $('#btn_delete').on('click', function(event){
            $.ajax({
                type: "DELETE",
                url: 'delete-pedido/'+deleteId,
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
        document.querySelector('#edProduto').value = null;
        document.querySelector('#edDescricao').value = null;
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
                document.querySelector('#edProduto').value = dados.name;
                document.querySelector('#edDescricao').value = dados.email;
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
        xhttp.open('get', 'get-pedido/'+id, true);
        xhttp.send();    
    }
</script>

    @endsection

@endsection