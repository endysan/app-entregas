@extends('crud.master')

@section('title','Dashboard')

@section('content')
<div class="container">
    <h2>Controle os registros</h2>
    
    <h4><a href="list-usuario">Usuarios</a></h4>
    <h4><a href="list-pedido">Pedido</a></h4>
    <h4><a href="list-entregador">Entregador</a></h4>
</div>
@endsection