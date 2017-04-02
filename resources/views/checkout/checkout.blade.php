<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container-fluid">
        <h2>Checkout App Entrega</h2>
        <hr/>

        <a href="{{ $link }}">
            <img src="img/209x48-pagar-assina.gif"/>
        </a>
    </div>
    @include('layouts.footer')

</body>
</html>
