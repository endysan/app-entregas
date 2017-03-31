<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')

<body>
    @include('layouts.nav')
    <div class="container-fluid">

        <div class="container-cadastro">

            <form method="POST" action="cadastro">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->

                <div class="bloco1">
                    <label for="name" class="form-label">Nome</label>
                    <input id="name" name="name" class="form-item" type="text">

                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" class="form-item" type="email">

                    <label for="password" class="form-label">Senha</label>
                    <input id="password" name="password" class="form-item" type="password">

                    <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                    <input id="password_confirmation" name="password_confirmation" class="form-item" type="password">
                </div>

                <div class="bloco2">
                    <label for="dt_nasc" class="form-label">Data de Nascimento</label>
                    <input id="dt_nasc" name="txt_dt_nasc" class="form-item" type="text">

                    <label for="telefone" class="form-label">Telefone</label>
                    <input id="telefone" name="txt_telefone" class="form-item" type="text">

                    <label for="whatsapp" class="form-label">Whatsapp</label>
                    <input id="whatsapp" name="txt_whatsapp" class="form-item" type="text">
                </div>

                <div class="bloco3">
                    <label for="" class="form-label">Estado</label>
                    <input id="" class="form-item" type="text">

                    <label for="" class="form-label">Cidade</label>
                    <input id="" class="form-item" type="text">

                    <label for="" class="form-label">Bairro</label>
                    <input id="" class="form-item" type="text">
                </div>

                <button id="btn-cadastro" class="btn-form" type="submit">Cadastrar</button>

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
    </div>
    @include('layouts.footer')
</body>
</html>