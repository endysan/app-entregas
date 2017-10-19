@extends('ver2.template.simple_master')

@section('title', 'Cadastrar')

@section('css')
<!-- CSS AQUI -->
@endsection

@section('content')
<div class="login-background d-md-flex flex-md-row-reverse" style="    background-image: url('img/img_background_entrega_01.jpg');">
        <div class="login-container mt-md-5 mr-md-5 p-md-5 mx-sm-auto">
            <h3 class="text-center mb-4">Entre para começar a usar!</h3>
            <form action="signup" method="POST">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control p-3" placeholder="João da Silva">
                </div>  
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control p-3" placeholder="exemplo@email.com">
                </div>    
                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>    
                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input type="password" id="password_confirmed" name="password_confirmed" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>    
            </form>
        </div>
    </div>
</div>
@endsection