@extends('template.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/historico_pedidos.css') }}">
@endsection

@section('content')
    <section id="section-pedidos">
        <div class="section-inner">
            <h3 class="titulo mt-2 ml-2"><span class="fa fa-truck fa-fw"></span>Todos os pedidos</h3>

            <div id="pedidos-container" class="">
            <div class="row">
            @if(!empty($pedidos))
                @foreach ($pedidos as $pedido)
                <div class="pedido-item">
                <a href="{{ url('cliente/pedido/id=' . $pedido->id) }}">
                <div class="row">
                    <div class="col-3">
                        <img class="pedido-img" src="{{ asset('storage/pedido/' . $pedido->img_pedido) }}" alt="">
                    </div>
                    <div class="col-6">
                        <div class="pedido-info">
                            <p class="pedido-title ellipsis">{{ $pedido->titulo }}</p>
                            <p class="pedido-description ellipsis">Descrição: {{ $pedido->descricao }}</p>
                            <p class="pedido-date">Data entrega: {{ Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="col-3 my-auto">
                    @if(strtolower($pedido->status_pedido) == 'pendente')    
                        <div class="status-container status_pendente">
                            
                            <p class="status">Pendente</p>
                        </div>
                    @elseif(strtolower($pedido->status_pedido) == 'aceito')
                        <div class="status-container status_aceito">
                            
                            <p class="status">Aceito</p>
                        </div>
                    @elseif(strtolower($pedido->status_pedido == 'entregue'))
                        <div class="status-container status_entregue">
                            
                            <p class="status">Entregue</p>
                        </div>

                    @elseif(strtolower($pedido->status_pedido) == 'cancelado' || $pedido->deleted_at != null)
                        <div class="status-container status_cancelado">
                            
                            <p class="status">Cancelado</p>
                        </div>
                    @endif
                    </div>
                </div> <!-- ROW -->
                </a>
            </div> <!-- Pedido-item -->
            @endforeach

            @else
                <div class="no-pedidos mx-auto p-5">
                    <div class="text-muted text-center" style="font-size: 24px;">
                        <p>Você ainda não fez pedidos</p>
                        <p>(;-;)</p>
                        <a href="{{ url('cliente/pedido/criar') }}" class="btn btn-light text-dark mt-5" style="border: 1px solid #888">Fazer pedido</a>
                    </div>
                    
                </div>
            @endif
            </div><!-- news_wrap -->
        </div>    
                
            <!-- foreach itens as item -->
                <!-- <div id="i-100" class="pedido-item"></div> -->
            <!-- endforeach -->
        </div>
        </section>
</div>
@endsection