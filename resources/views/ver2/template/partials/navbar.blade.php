<nav class="navbar row">
    <div class="navbar-left pl-2">
        <div class="nav-item">
            @if(Auth::check())
            <div id="nav-open">
                <i class="nav-toggle fa fa-bars fa-lg"></i>
                <span>Menu</span>
            </div>
            @endif
        </div>
        <div class="nav-item">
            <div class="navbar-logo">
                <!-- Link de redirecionamento diferentes se estiver logado -->
                @if(Auth::check())
                <a href="{{ url('dashboard') }}"><img src="{{ url('img/vs4.png') }}"></a>
                @else
                <a href="{{ url('/') }}"><img src="{{ url('img/vs4.png') }}"></a>
                @endif
                <!-- ============================================== -->
            </div>
        </div>
    </div>

    <div class="navbar-right">
        <!-- If logado -->
        @if(! Auth::check())
            <div class="nav-item">
                <a href="{{ url('login') }}" class="text-appentrega">Login</a>
            </div>
            <div class="nav-item">
                <a href="{{ url('signup') }}" class="entrega-button bg-appentrega">Cadastrar</a>
            </div>
        @endif
    </div>
</nav>