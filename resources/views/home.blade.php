<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container-fluid">
        <h2>Home App Entrega</h2>

        <a href="#">Login</a>
        <a href="#">Cadastre-se</a>

        <p class="dangan">{{ $content }}</p>

        
    </div>
    @include('layouts.footer')
</body>
</html>