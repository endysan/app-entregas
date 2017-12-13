@extends('template.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/historico_pedidos.css') }}">
@endsection

@section('content')
    <section id="section-pedidos">
        <div class="section-inner">
            <h3 class="titulo mt-2 ml-2"><span class="fa fa-truck fa-fw"></span>Acompanhar os pedidos</h3>

            <div id="pedidos-container" class="">
            <div class="row">
            @if(count($propostas) > 0)
                @foreach ($propostas as $proposta)
                <div class="pedido-item">
                <a href="{{ url('entregador/pedido/id=' . $proposta->pedido->id) }}">
                <div class="row">
                    <div class="col-3">
                        @if($proposta->pedido->img_pedido != null)
                        <img src="{{ asset('storage/pedido/' . $proposta->pedido->img_pedido) }}" style="max-width: 100%">
                        @else
                        <img src="{{ asset('storage/pedido/produto-sem-imagem.gif') }}" style="max-width: 100%">
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="pedido-info">
                            <p class="pedido-title ellipsis">{{ $proposta->pedido->titulo }}</p>
                            <p class="pedido-description ellipsis">Descrição: {{ $proposta->pedido->descricao }}</p>
                            <p class="pedido-date">Data entrega: {{ Carbon\Carbon::parse($proposta->pedido->data_entrega)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="col-3 my-auto">
                    @if(strtolower($proposta->pedido->status_pedido) == 'pendente')    
                        <div class="status-container status_pendente">
                            
                            <p class="status">Pendente</p>
                        </div>
                    @elseif(strtolower($proposta->pedido->status_pedido) == 'aceito')
                        <div class="status-container status_aceito">
                            
                            <p class="status">Aceito</p>
                        </div>
                    @elseif(strtolower($proposta->pedido->status_pedido == 'entregue'))
                        <div class="status-container status_entregue">
                            
                            <p class="status">Entregue</p>
                        </div>

                    @elseif(strtolower($proposta->pedido->status_pedido) == 'cancelado' || $proposta->pedido->deleted_at != null)
                        <div class="status-container status_cancelado">
                            
                            <p class="status">Cancelado</p>
                        </div>
                    @endif
                    </div>
                </div> <!-- ROW -->
                </a>
            </div> <!-- Pedido-item -->
            @endforeach
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