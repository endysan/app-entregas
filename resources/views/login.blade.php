<!DOCTYPE>
<html>
@include('layouts.header')

<body>
    @include('layouts.nav')
    <div class="container-login">
        <div class="signin">
            <h2>Comece agora!</h2>
            <form action="/login" method="POST">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->

                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-item" type="text" name="txt_email">
                
                <label for="senha" class="form-label">Senha</label>
                <input id="senha" class="form-item" type="password" name="txt_senha">
                
                <button class="btn-form" type="submit">Entrar</button>

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
            
            <p class="text-cadastrar">Se não possui cadastro clique <a href="cadastrar.html">aqui</a></p>
        </div>
        
    </div>
    @include('layouts.footer')
</body>
</html>