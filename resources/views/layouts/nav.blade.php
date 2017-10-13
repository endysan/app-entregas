<nav class="nav-container">

    <div class="nav-left">
        <li class="nav-item">
        @if(session()->has('admin'))
            <a class="nav-link" href="{{ url('list') }}"><img class="logo" src="{{ url('img/logo.png') }}"/></a>
        @else
            <a class="nav-link" href="{{ url('home') }}"><img class="logo" src="{{ url('img/logo.png') }}"/></a>
        @endif
        </li>
        @if(Auth::check())
        <li class="nav-item">
            <a class="nav-link" href="{{ url('pedidos') }}">Fazer pedido</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('entregar') }}">Realizar entrega</a>
        </li>
        @endif
    </div>

    <div class="nav-right">
        @if(Auth::check())
            <li class="nav-item">
                <!-- NOME DO USUARIO | LINK EDITAR PERFIL -->
                <a class="nav-link" href="{{ url('editar') }}">{{ Auth::user()->name}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('logout') }}">Sair</a>
            </li>
        @else
            
            @if(session()->has('admin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout-admin') }}">Admin Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('login-admin') }}">Admin</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ url('login') }}">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('cadastro') }}">Cadastrar</a>
            </li>
        @endif
    </div> <!-- NAVBAR RIGHT-->
</nav>
