@extends('crud.master')

@section('title','Dashboard')

@section('content')
<div class="container">
    <h2>Controle os registros</h2>
    
    <h4><a href="list-usuario">Usuarios</a></h4>
    <h4><a href="list-pedido">Pedidos</a></h4>
    <h4><a href="list-entregador">Entregadores</a></h4>
    <h4><a href="list-entrega">Entregas</a></h4>
    <h4><a href="list-endereco">Endereços*</a></h4>
</div>
@endsection