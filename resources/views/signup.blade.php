@extends('template.simple_master')

@section('title', 'Cadastrar')

@section('css')
<link rel="stylesheet" href="{{ url('css/signup.css') }}">
<style>
    .tipo-cadastro {
        text-align: center;
    }
    .tipo-cadastro img {
        height: 80px;
        border-radius: 10px; 
        padding: 5px;
    }
    .tipo-cadastro > p {
        margin: 0;
    }
    label > input {
        visibility: hidden;
        position: absolute;
    }
    label > input + img {
        cursor: pointer;
        border: 1px solid rgba(100,100,100,0.2);
    }
    label > input:checked + img {
        border: 2px solid rgb(60,60,60); 
    }
    form button[type="submit"] {
        width: 100%;
    }
    #section_tipo_cadastro {
        background-color: rgb(248,248,251);
        border-radius: 10px;
    }
</style>
@endsection
@include('template.partials.navbar')

@section('content')

<!-- cadastro usuario ============ -->
<div class="signup-background d-flex flex-row">
        <div class="signup-container mt-md-5 mr-md-5 mx-md-auto mx-sm-auto">
            <h3 class="text-center mb-4">Cadastre-se e começar a usar!</h3>
            <!-- -->
            <form id="form_cadastro_cliente" action="signup" method="POST">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->
                <div class="row">
                    <div class="col-6">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control p-3" placeholder="João da Silva" required>
                    </div>
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control p-3" placeholder="exemplo@email.com" required>
                    </div>
                </div>  
                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>    
                <div class="mt-2">
                    <label for="password">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>

                <div class="mt-2">
                    <label for="section_tipo_cadastro">Selecione tipo de cadastro</label>
                    <section id="section_tipo_cadastro" class="p-2">
                        <div class="row">
                            <div class="tipo-cadastro col-6">
                                <p style="font-size: 18px">Cliente</p>
                                <label>
                                    <input type="radio" name="radioTipoCadastro" value="cliente">
                                    <img src="{{ url('img/home/mao.png') }}" alt="">
                                </label>
                                <p class="text-muted">Desejo fazer pedidos de entrega.</p>
                            </div>

                            <div class="tipo-cadastro col-6">
                                <p style="font-size: 18px">Entregador</p>
                                <label>
                                    <input type="radio" name="radioTipoCadastro" value="entregador">
                                    <img src="{{ url('img/home/caminhao.png') }}" alt="">
                                </label>
                                <p class="text-muted">Desejo realizar entregas para outros</p>
                            </div>
                        </div>
                    </section>
                </div>
                
                <button type="submit" class="btn btn-default btn-lg bg-appentrega text-light mt-4">Cadastrar</button>
            </form>
            <!-- -->
        </div>
    </div>
</div>
<!-- fim cadastro usuario ======== -->

@endsection