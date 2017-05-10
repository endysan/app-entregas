@extends ('crud.master')

@section('title', 'Entregadores')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content')

   <div class="container-fluid" style="background-color: white;">
    <h3>Entregadores</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>ID Usuario</th>
            <th>Veículo</th>
            <th>CNH</th>
            <th>Status</th>
            <th></th>
        </tr>
        @foreach($entregadores as $entregador)
        <tr>
            <td>{{ $entregador->id }}</td>
            <td>{{ $entregador->id_usuario }}</td>
            <td>{{ $entregador->veiculo }}</td>
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
                <input type="text" class="form-control" name="cnh" placeholder="CNH" maxlength="10">
            </div>
            <div class="form-group">
                <select name="id_usuario" class="form-control" required>
                    <option selected hidden value="">Entregadores</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select id="veiculo" name="veiculo" class="form-control" required>
                    <option selected hidden value="">Veículo</option>
                    <option value="carro">Carro</option>
                    <option value="caminhao">Caminhão</option>
                    <option value="moto">Moto</option>
                </select>
            </div>
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form id="form-editar" class="form-crud" method="POST" action="edit-entregador">
            
            <input type="hidden" id="edId" name="id">
            <div class="form-group">
                <input type="text" id="edCnh" class="form-control" name="cnh" placeholder="CNH" maxlength="10">
            </div>
            <div class='form-group'> 
                <select id="edVeiculo" name="veiculo" class="form-control">
                    <option selected hidden value="">Veículo</option>
                    <option value="carro">Carro</option>
                    <option value="caminhao">Caminhão</option>
                    <option value="moto">Moto</option>
                </select>
            </div>
            <div class="form-group">
                <select id="edStatus" name="status" class="form-control">
                    <option selected hidden value="">Status</option>
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

                    setTimeout(location.reload(), 50);
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
        document.querySelector('#edCnh').value = null;
        document.querySelector('#edVeiculo').value = null;
        document.querySelector('#edStatus').value = null;
    }

    function getById(id)
    {
        $.ajax({
                type: "GET",
                url: 'get-entregador/'+id,
                success: function(dados){
                    console.log("{GET entregador} Sucesso");
                    $('#edCnh').val(dados.cnh);
                    // $('#edVeiculo[value="'+dados.veiculo+'"').prop('selected', 'selected');
                    // $('#edStatus[value="'+dados.status+'"').prop('selected', 'selected');
                },
                error: function(error){
                    console.log("{GET entregador} Erro");
                    console.log(error);
                }
            });
    //     clearEditText();
    //     var xhttp = new XMLHttpRequest();
    //     xhttp.onload = function() {
    //         if(xhttp.readyState == 4 && xhttp.status == 200) {
    //             var dados = JSON.parse(xhttp.responseText);
    //             document.querySelector('#edCnh').value = dados.cnh;
    //             document.querySelector('#edVeiculo').value = dados.veiculo;
    //             document.querySelector('#edStatus').value = dados.status;
    //             document.querySelector('#edId').value = id;
    //             console.log(dados);
    //         }
    //         else {
    //             console.log("Resposta ainda não chegou ou houve um erro");
    //         }
    //     }
    //     xhttp.open('get', 'get-entregador/'+id, true);
    //     xhttp.send();    
    }
</script>

    @endsection

@endsection