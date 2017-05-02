@extends ('crud.master')

@section('title', 'Pedidos')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content') 
<div class="container-fluid" style="background-color: white;">
    <h3>Pedidos</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Descrição</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th></th>
        </tr>
        
        <tr>
            @foreach($pedidos as $pedido)
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->produto }}</td>
                <td>{{ $pedido->descricao }}</td>
                <td>{{ $pedido->estado }}</td>
                <td>{{ $pedido->cidade }}</td>
                <td>{{ $pedido->bairro }}</td>
                <td>
                <input type="hidden" name="user_id" value="{{ $pedido->id }}">
                <button class="btn btn-success" type="button"
                    data-toggle="modal" data-target="#modalEditar" onclick="editById({{ $pedido->id }})">
                    Editar
                </button>

                <button class="btn btn-danger" type="button"
                data-toggle="modal" data-target="#modalDeletar" onclick="deleteId = {{ $pedido->id}}">
                    Excluir
                </button>
            </td>
            @endforeach
        </tr>
        
    </table>

   
</div>
@endsection

@section('modal-cadastrar')

@endsection

@section('modal-editar')
@endsection

@section('modal-deletar')
@endsection