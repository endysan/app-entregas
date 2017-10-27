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
        border: 1px solid rgb(140,140,140); 
        border-radius: 10px; 
        padding: 5px;
        
    }
</style>
@endsection

@section('content')

<!-- cadastro usuario ============ -->
<div class="signup-background d-flex flex-row">
        <div class="signup-container mt-md-5 mr-md-5 p-md-5 mx-md-auto mx-sm-auto">
            <h3 class="text-center mb-4">Cadastre-se e começar a usar!</h3>
            <!-- -->
            <form id="form_cadastro_cliente" action="signup" method="POST">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->
                <section id="section_tipo_cadastro">
                    <div class="row">
                        <div class="tipo-cadastro col-6">
                            <h3>Cliente</h3>
                            <input type="radio" name="radioTipoCadastro" value="cliente">
                            <img src="{{ url('img/home/mao.png') }}" style="height: 80px; border: 1px solid rgb(140,140,140); border-radius: 10px; padding: 5px;" alt="">
                            <p class="text-muted">Desejo fazer pedidos de entrega.</p>
                        </div>

                        <div class="tipo-cadastro col-6">
                            <h3>Entregador</h3>
                            <input type="radio" name="radioTipoCadastro" value="entregador">
                            <img src="{{ url('img/home/caminhao.png') }}" alt="">
                            <p class="text-muted">Desejo realizar entregas para outros</p>
                        </div>
                    </div>
                </section>

                <div>
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control p-3" placeholder="João da Silva" required>
                </div>  
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control p-3" placeholder="exemplo@email.com" required>
                </div>    
                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>    
                <div class="mt-2">
                    <label for="password">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control p-3" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>

                <button type="submit" class="btn btn-default bg-appentrega text-light mt-3">Cadastrar</button>
            </form>
            <!-- -->
        </div>
    </div>
</div>
<!-- fim cadastro usuario ======== -->

@endsection