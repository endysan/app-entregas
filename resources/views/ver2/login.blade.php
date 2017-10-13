@extends('ver2/template/simple_master')

@section('title', 'Login')

@section('css')
<link rel="stylesheet" href="{{ url('css/ver2/login.css') }}">
@endsection

@section('content')
    <div class="login-background d-md-flex flex-md-row-reverse" style="    background-image: url('img/img_background_entrega_01.jpg');">
        <div class="login-container mt-md-5 mr-md-5 p-5 mx-sm-auto">
            <h3 class="text-center mb-4">Entre para começar a usar!</h3>
            <form action="login" method="POST">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control p-3" placeholder="exemplo@email.com">
                </div>    
                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>    
                <div class="d-flex justify-content-between align-items-end">
                    <div class="p-2"><a href="#" class="text-muted">Esqueci minha <span class="text-appentrega">senha</span></a></div>
                    <div>
                        <button type="submit" class="btn btn-default btn-lg bg-appentrega mt-4">Login
                            <i class="fa fa-chevron-right fa-fw"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection