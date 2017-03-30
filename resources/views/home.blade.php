<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container">
        <h2>Home App Entrega</h2>

        <a href="#">Login</a>
        <a href="#">Cadastre-se</a>

        <p class="dangan">{{ $content }}</p>

        @include('layouts.footer')
    </div>
</body>
</html>