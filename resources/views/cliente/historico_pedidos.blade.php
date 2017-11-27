@extends('template.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ url('css/historico_pedidos.css') }}">
@endsection

@section('content')
    <section id="section-pedidos">
        <div class="section-inner">
            <h3 class="titulo mt-2 ml-2"><span class="fa fa-truck fa-fw"></span>Todos os pedidos</h3>

            <div id="news_box_wrap" class="">
            @if(count($pedidos) >= 1)
                @foreach ($pedidos as $pedido)
                <a class="pedido_link" href="{{ url('cliente/pedido/id=') . $pedido->id }}">    
                    <div id="" class="news_box">
                        <div id="pedido_status" class="p-2 status_pendente">
                            <p style="margin: 0">Status: Pendente</p>
                        </div>
                            <figure>
                                <img src="{{ asset('storage/' . $pedido->img_pedido) }}">
                                
                                <div id="" class="figure_read">
                                    Mais detalhes
                                </div>
                            </figure>
                        
                        <div id="" class="box_inner">
                            <div id="" class="contents">
                                <h3 class="ellipsis">{{ $pedido->titulo }}</h3>
                                <p class="ellipsis">{{ $pedido->descricao }}</p>
                            </div>
                            <div id="" class="category left announce text-appentrega">
                                <p>Data de entrega: {{ Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y') }}</p>
                            </div>
                        </div><!-- box_inner -->
                    </div><!-- newsbox -->
                </a>
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
                
                
            <!-- foreach itens as item -->
                <!-- <div id="i-100" class="pedido-item"></div> -->
            <!-- endforeach -->
        </div>
        </section>
</div>
@endsection