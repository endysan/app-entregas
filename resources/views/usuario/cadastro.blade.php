@extends('layouts.master')

@section('title', 'Cadastrar')

@section('css')
<link rel="stylesheet" href="css/cadastro.css">
@endsection
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
</script>
@section('content')
        <div class="container-cadastro">

            <form method="POST" action="cadastro">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->

                <div class="signup">
                    <h2>Cadastre-se agora</h2>
                    
                    <div class="form-group">
                        <aside>
                            <label for="name" class="form-label">Nome</label>
                        </aside>
                        
                        <div>
                            <input id="name" name="name" class="form-item" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <aside>
                            <label for="email" class="form-label">Email</label>
                        </aside>
                        <div>
                            <input id="email" name="email" class="form-item" type="email" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <aside>
                            <label for="password" class="form-label">Senha</label>
                        </aside>
                        <div>
                            <input id="password" name="password" class="form-item" type="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <aside>
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                        </aside>
                        <div>
                            <input id="password_confirmation" name="password_confirmation" class="form-item" type="password" required>
                        </div>
                    </div>
                    <font color="red" id="erro"></font>
                    <div class="form-group-btn">
                        <button id="btn" class="button button-purple" type="submit" onClick="confirmar()">Cadastrar</button>
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
                    @if (session()->has('errorMessage'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ session()->get('errorMessage') }}</li>
                        </ul>
                    </div>
                    @endif
                </div>
            </form>
    </div>
   @endsection