@extends('layouts.master')
@section('title', 'Login')

@section('css')
<link rel="stylesheet" href="css/login.css">
@endsection

@section('content')
<script>
function confirmar()
{
var password = document.getElementById('password').value;
var password_confirmation = document.getElementById('password_confirmation').value;
var erro = document.getElementById('erro');

    if (password != password_confirmation)
    {
        erro.innerHTML = 'Senhas não coincidem.';
        event.preventDefault();
    }
}
$(document).ready(function(){
    $('#form').on('submit', function(event){
        event.preventDefault();
        
        $.ajax({
          type: "POST",
          url: "{{ url('login') }}",
          data: $('form').serialize(),
          success: function(response){
              console.log(response);
          },
          error: function(erro) {
              console.log("ERRO: ", erro);
          }
          
        });
        
    });
});
</script>

    <div class="container-login">
        <div class="signin">
            <h2>Comece agora!</h2>

            <form id="form" action="login" method="POST" class="login-form">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->

                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-item" type="email" name="email">
                
                <label for="password" class="form-label">Senha</label>
                <input id="password" class="form-item" type="password" name="password">
                
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
            
            <p class="text-cadastrar">Se não possui cadastro clique <a href="cadastro">aqui</a></p>
        </div>
        
    </div>
@endsection