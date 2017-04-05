<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container">
       <h2>Alguns testes com mapas</h2>

        <table>
            <tr>
                <th>Origem</th>
                <th>Destino</th>
                <th>Distancia</th>
            </tr>

            <tr>
                {{ $distancia }}
            </tr>
        </table>
    </div>
    @include('layouts.footer')
</body>
</html>