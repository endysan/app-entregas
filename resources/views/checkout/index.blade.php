<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container">
        
        <div class="checkout-container">
            <h2>Pagar pelo seu pedido</h2>
            <hr/>
            <form action="checkout" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="type" id="nome" name="nome" class="form-item">
                </div>

                <div class="form-group">
                    <label for="produto" class="form-label">Nome produto</label>
                    <input type="type" id="produto" name="produto" class="form-item">
                </div>

                <div class="form-group">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="number" id="valor" name="valor" class="form-item">
                </div>

                <button type="submit" class="btn-form">Comprar</button>

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

    <script type="text/javascript" 
    src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
    </script>
    
</body>
</html>