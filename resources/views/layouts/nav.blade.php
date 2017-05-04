<nav class="nav-container">

    <div class="nav-left">
        <li class="nav-item">
            <a class="nav-link" href="home">Home</a>
        </li>
        @if(Auth::check())
        <li class="nav-item">
            <a class="nav-link" href="pedidos">Pedidos</a>
        </li>
        @endif
    </div>

    <div class="nav-right">
        @if(Auth::check())
            <li class="nav-item">
                <!-- NOME DO USUARIO | LINK EDITAR PERFIL -->
                <a class="nav-link" href="editar">{{ Auth::user()->name}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout">Sair</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="login-admin">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="cadastro">Cadastrar</a>
            </li>
        @endif
    </div> <!-- NAVBAR RIGHT-->
</nav>
