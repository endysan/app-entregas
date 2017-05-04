<nav class="nav-container">

    <div class="nav-left">
        <li class="nav-item">
        @if(session()->has('admin'))
            <a class="nav-link" href="list">Home</a>
        @else
            <a class="nav-link" href="home">Home</a>
        @endif
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
            
            @if(session()->has('admin'))
                <li class="nav-item">
                    <a class="nav-link" href="logout-admin">Admin Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="login-admin">Admin</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="login">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="cadastro">Cadastrar</a>
            </li>
        @endif
    </div> <!-- NAVBAR RIGHT-->
</nav>
