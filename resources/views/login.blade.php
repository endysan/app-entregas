@extends('template.simple_master')

@section('title', 'Login')

@section('css')
<link rel="stylesheet" href="{{ url('css/login.css') }}">
@endsection

@section('content')

<!-- Verificar -->
<div class="logo p-2 d-md-flex">
    <a href="{{ url('/') }}" class="mx-auto">
        <h2 style="text-transform: uppercase; color: black">
            <span style="color: #A0634E;">App</span>Entrega
        </h2>    
    </a>
</div>
<!-- Verificar -->

    <div class="login-background d-md-flex flex-md-row-reverse">
        <div class="login-container border-appentrega mt-md-3 p-md-5 mx-auto">
            <h4 class="text-center mb-4">Entre para começar a usar!</h4>
            <form action="login" method="POST">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control p-3" placeholder="exemplo@email.com">
                </div>    
                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>    
                
                <div class="button-login">
                    <button type="submit" style="width: 100%" class="btn btn-default btn-lg bg-appentrega mt-4">Login
                        <i class="fa fa-chevron-right fa-fw"></i>
                    </button>
                </div>
                <div>
                    <div class="p-2"><a href="#" class="text-muted">Esqueci minha <span class="text-appentrega">senha</span></a></div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Area cadastro -->
    <div id="login_cadastro_section" class="d-md-flex flex-md-row-reverse">
        <div class="pt-3 p-2 mx-auto border-appentrega">
            <p>Ainda não possui cadastro? <a class="text-appentrega" href="{{ url('signup') }}">Criar agora</a></p>
        </div>
    </div>

</div>


@endsection