@extends ('crud.master')

@section('title', 'Entregas')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content')

   <div class="container-fluid" style="background-color: white;">
    <h3>Entregas</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>ID Pedido</th>
            <th>ID Entregador</th>
            <th>Status</th>
            <th></th>
        </tr>
        @foreach($entregas as $entrega)
        <tr>
            <td>{{ $entrega->id }}</td>
            <td>{{ $entrega->id_pedido }}</td>
            <td>{{ $entrega->id_entregador }}</td>
            <td>{{ $entrega->status }}</td>
            <td>
                <input type="hidden" name="entrega_id" value="{{ $entrega->id }}">
                <button class="btn btn-success" type="button"
                    data-toggle="modal" data-target="#modalEditar" onclick="editId = {{ $entrega->id }}; 
                    getById(editId);">
                    Editar
                </button>

                <button class="btn btn-danger" type="button"
                data-toggle="modal" data-target="#modalDeletar" onclick="deleteId = {{ $entrega->id }}">
                    Excluir
                </button>
            </td>
        </tr>
        @endforeach

    </table>
    @section('modal-cadastrar')
        <form id="form-cadastrar" class="form-crud" method="POST" action="create-entrega">
            
        <input type="hidden" name="edId">
        <div class='form-group'> 
                <select id="pedido" name="id_pedido" class="form-control">
                    <option selected hidden value="">Produtos</option>
                    @foreach($pedidos as $pedido)
                        <option value="{{ $pedido->id }}">{{ $pedido->produto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select id="entregador" name="id_entregador" class="form-control">
                    <option selected hidden value="">Entregador</option>
                    @foreach($entregadores as $entregador)
                        <option value="{{ $entregador->id }}">{{ $entregador->email }}</option>                
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="dt_entrega" class="form-control" name="dt_entrega" 
                placeholder="dd/mm/aaaa" maxlength="10">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form id="form-editar" class="form-crud" method="POST" action="edit-entrega">
            
            <input type="hidden" id="edId" name="id">
            <div class='form-group'> 
                <select id="edPedido" name="id_pedido" class="form-control">
                    <option selected hidden value="">Produto</option>
                    @foreach($pedidos as $pedido)
                        <option value="{{ $pedido->id }}">{{ $pedido->produto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select id="edEntregador" name="id_entregador" class="form-control">
                    <option selected hidden value="">Entregador</option>
                    @foreach($entregadores as $entregador)
                        <option value="{{ $entregador->id }}">{{ $entregador->email }}</option>                
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="edDt_entrega" class="form-control" name="dt_entrega" 
                placeholder="dd/mm/aaaa" maxlength="10">
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
        $('#dt_entrega, #edDt_entrega').mask('00/00/0000');
                
        $('#form-editar').on('submit', function(event){
            var entrega = $('#form-editar').serialize();
            $.ajax({
                type: 'PUT',
                url: 'edit-entrega/'+editId,
                data: entrega,
                success: function(response){
                    console.log(response);
                    console.log(entrega);

                    setTimeout(location.reload(), 50);
                },
                error: function (response){
                    console.log("ERROR");
                    console.log(response);
                    console.log(entrega);
                }
            });
            event.preventDefault();
        });

        $('#btn_delete').on('click', function(event){
            $.ajax({
                type: "DELETE",
                url: 'delete-entrega/'+deleteId,
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
        document.querySelector('#edDt_entrega').value = null;
    }

    function getById(id)
    {
        $.ajax({
                type: "GET",
                url: 'get-entrega/'+id,
                success: function(dados){
                    console.log("{GET entrega} Sucesso");
                    $('#edDt_entrega').val(dados.dt_entrega);
                },
                error: function(error){
                    console.log("{GET entrega} Erro");
                    console.log(error);
                }
            });
    }
</script>

    @endsection

@endsection