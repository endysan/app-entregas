<div id="sidebar-main" class="sidebar-main sb-hidden">

    <div class="sidebar-inner card text-dark bg-light mb-3" style="width: 17rem;">
    <div class="card-header">
        <i id="nav-close" class="fa fa-close mr-2 pr-5 pl-1 mt-2"></i>
    </div>
        <div class="card-body">
            <div style="display: inline-block;">
                <img src="img/morgana.png" class="rounded-circle" style="width: 65px; height: 65px;">
                <p class="card-text">{{ Auth::user()->name }}</p>
            </div>
        </div>
        <div class="card-body">
           
            <a href="{{ url('dashboard') }}" class="text-dark card-link"><i class="fa fa-home fa-fw fa-lg mr-1"></i>Dashboard</a> 
        </div>
        <div class="card-body">
           <a href="{{ url('pedidos') }}" class="text-dark card-link"><i class="fa fa-plus fa-fw fa-lg mr-1"></i>Fazer pedidos</a> 
        </div>
        <div class="card-body">
           <a href="{{ url('historico') }}" class="text-dark card-link"><i class="fa fa-file-text fa-fw fa-lg mr-1"></i>Meus pedidos</a> 
        </div>
        <!-- IF entregador -->
        <div class="card-body">
           <a href="{{ url('mapa-pedidos') }}" class="text-dark card-link"><i class="fa fa-truck fa-fw fa-lg mr-1"></i>Realizar Entregas</a> 
        </div>
        <!-- END IF entregador -->
    </div>
</div>