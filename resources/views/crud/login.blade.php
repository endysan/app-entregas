@extends('crud.master')

@section('title', 'Login Admin')

@section('css')
    <link rel="stylesheet" href="css/login.css">
@endsection

@section('content')
    <div class="container-login">
        <div class="signin">
            <h2>Admin login</h2>

            <form action="login-admin" method="POST" class="login-form">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->

                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-item" type="email" name="email">
                
                <label for="password" class="form-label">Senha</label>
                <input id="password" class="form-item" type="password" name="senha">
                
                <button class="button button-purple" type="submit">Entrar</button>

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
            
            <p class="text-cadastrar">Se não possui cadastro clique <a href="cadastro.html">aqui</a></p>
        </div>
        
    </div>
@endsection