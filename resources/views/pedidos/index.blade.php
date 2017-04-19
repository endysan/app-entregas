@extends('layouts.master')

@section('title', 'Criar Pedidos')


@section('css')
    <link rel="stylesheet" href="css/pedido.css">
@endsection


@section('content')
<div class="container-pedido">
    <h2>Criar um pedido</h2>
    
    <form method="POST" action="pedido">
        {{ csrf_field() }} <!-- Obrigatorio para segurança -->

        <div class="bloco1">
            <p class="muted">Informações do seu produto</p>
            <div class="form-group">
                <label for="produto" class="form-label">Seu produto</label>
                <input id="produto" name="produto" class="form-item" type="text">
            </div>

            <div class="form-group">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-item">
                </textarea>
            </div>  

            <div class="form-group">
                <label for="password" class="form-label">Senha</label>
                <input id="password" name="password" class="form-item" type="password">
            </div>

            
        </div>


        <div class="bloco2">
            <hr/>
            <p class="muted">Informações de entrega</p>
            <div class="form-group">
                <label for="" class="form-label">Estado</label>
                <input id="" class="form-item" type="text">
            </div>

            <div class="form-group">
                <label for="" class="form-label">Cidade</label>
                <input id="" class="form-item" type="text">
            </div>

            <div class="form-group">
                <label for="" class="form-label">Bairro</label>
                <input id="" class="form-item" type="text">
            </div>
        </div>

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Criar Pedido</button>
        </div>

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
</div>
@endsection