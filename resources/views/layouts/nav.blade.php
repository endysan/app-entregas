<nav class="nav-container">

    <div class="nav-left">
        <li class="nav-item">
            <a class="nav-link" href="home">Home</a>
        </li>
        @if(Auth::check())
        <li class="nav-item">
            <a class="nav-link" href="checkout">Realizar Compra</a>
            <a class="nav-link" href="maps">Teste Maps</a>
        </li>
        @endif
    </div>

    <div class="nav-right">
        @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="#">{{ Auth::user()->name}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout">Sair</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="login">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="cadastro">Cadastrar</a>
            </li>
        @endif
    </div> <!-- NAVBAR RIGHT-->
</nav>
