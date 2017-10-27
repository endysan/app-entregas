<nav class="navbar row">
    <div class="navbar-left mr-auto pl-2">
        @if(Auth::check())    
        @php 
            $isEntregador = Auth::user()->isEntregador;
            $urlPrefix = Auth::user()->entregador_id == null ? 'cliente' : 'entregador';
        @endphp
            <div class="nav-item">
                <div id="nav-open">
                    <i class="nav-toggle fa fa-bars fa-lg"></i>
                    <span>Menu</span>
                </div>
            </div>
        @endif
        <div class="nav-item">
            <div class="navbar-logo">
                <!-- Link de redirecionamento diferentes se estiver logado -->
                @if(Auth::check())
                    <a href="{{ url($urlPrefix . '/dashboard') }}"> <!-- link home -->
                @else
                <a href="{{ url('/') }}"> <!-- link home -->
                @endif
                    <h2 class="logo" style="text-transform: uppercase; color: black">
                        <span style="color: #A0634E;">App</span>Entrega
                    </h2>    
                    <!-- <img src="{{ url('img/vs4.png') }}"> -->
                </a> <!-- link home -->
                <!-- ============================================== -->
                </div>
            </div>
    </div><!-- Navbar-right -->

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