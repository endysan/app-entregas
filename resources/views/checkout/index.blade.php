<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container-fluid">
        <h2>Pagar pelo seu pedido</h2>
        <hr/>

        <form action="checkout" method="post">
            {{ csrf_field() }}

            <label for="nome" class="form-label">Nome</label>
            <input type="type" id="nome" name="nome" class="form-item">

            <label for="produto" class="form-label">Nome produto</label>
            <input type="type" id="produto" name="produto" class="form-item">

            <label for="valor" class="form-label">Valor</label>
            <input type="number" id="valor" name="valor" class="form-item">

            <button type="submit" class="btn">Comprar</button>
        </form>
        
    </div>
    @include('layouts.footer')

    <script type="text/javascript" 
    src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
    </script>
    
</body>
</html>