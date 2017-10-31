@if(Auth::check())
    @php 
        $isEntregador = Auth::user()->isEntregador;
        $urlPrefix = Auth::user()->entregador_id == null ? 'cliente' : 'entregador';
    @endphp
<div id="sidebar-main" class="sidebar-main sb-hidden">

    <div class="sidebar-inner text-dark bg-light mb-3" style="width: 17rem;">
    <div class="card-header">
        <i id="nav-close" class="fa fa-close mr-2 pr-5 pl-1 mt-2"></i>
    </div>
        <div class="card-body">
            <div style="display: inline-block;">
                <a href="{{ url($urlPrefix . '/perfil') }}">
                <img src="img/morgana.png" class="rounded-circle" style="width: 65px; height: 65px;">
                </a>
                
                <p class="card-text">{{ Auth::user()->nome }}</p>
                
            </div>
        </div>
        <div class="card-body">
            <a href="{{ url($urlPrefix . '/dashboard') }}" class="text-dark card-link">
                <i class="fa fa-home fa-fw fa-lg mr-1"></i>
                Dashboard
            </a> 
        </div>
        @if(! $isEntregador)
        <div class="card-body">
            <a href="{{ url($urlPrefix . '/pedido/criar') }}" class="text-dark card-link"><i class="fa fa-plus fa-fw fa-lg mr-1"></i>Fazer pedidos</a> 
        </div>
        <div class="card-body">
            <a href="{{ url($urlPrefix . '/historico') }}" class="text-dark card-link"><i class="fa fa-file-text fa-fw fa-lg mr-1"></i>Meus pedidos</a> 
        </div>

        <!-- IF entregador -->
        @elseif($isEntregador)
        <div class="card-body">
           <a href="{{ url($urlPrefix . '/entregas-aceitas') }}" class="text-dark card-link"><i class="fa fa-file-text fa-fw fa-lg mr-1"></i>Entregas aceitas</a> 
        </div>
        <div class="card-body">
           <a href="{{ url($urlPrefix . '/veiculos') }}" class="text-dark card-link"><i class="fa fa-car fa-fw fa-lg mr-1"></i>Seus Veiculos</a> 
        </div>
        <div class="card-body">
           <a href="{{ url($urlPrefix . '/mapa-pedidos') }}" class="text-dark card-link"><i class="fa fa-truck fa-fw fa-lg mr-1"></i>Realizar Entregas</a> 
        </div>
        @endif
        <div class="card-body">
           <a href="{{ url('logout') }}" class="text-dark card-link"><i class="fa fa-sign-out fa-fw fa-lg mr-1"></i>Sair</a> 
        </div>
        <!-- END IF entregador -->
    </div>
</div>
@endif