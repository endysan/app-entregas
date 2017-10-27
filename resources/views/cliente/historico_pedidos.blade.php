@extends('template.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ url('css/historico_pedidos.css') }}">
@endsection

@section('content')
    <section id="section-pedidos">
        <div class="section-inner">
            <h3 class="text-muted mt-2 ml-2"><span class="fa fa-truck fa-fw"></span>Todos os pedidos</h3>

            <div id="news_box_wrap" class="">
            @if(count($pedidos) >= 1)
                @foreach ($pedidos as $pedido)
                    <div id="" class="news_box">

                        <a href="{{ url('cliente/pedido/id=') . $pedido->id }}">

                            <figure>
                                <img src="img/placeholder.png">
                                <div id="" class="figure_read">
                                    Mais detalhes
                                </div>
                            </figure>
                        </a>
                        <div id="" class="box_inner">
                            <div id="" class="contents">
                                <h3 class="ellipsis">{{ $pedido->titulo }}</h3>
                                <p class="ellipsis">{{ $pedido->descricao }}</p>
                            </div>
                            <div id="" class="bottom">
                                <div id="" class="category left announce text-appentrega">
                                    Distância: <?= "59km" ?>
                                </div>
                                <div id="" class="date right">
                                    {{ Carbon\Carbon::parse($pedido->dt_entrega)->format('d/m/Y') }}
                                </div>
                            </div>
                        </div><!-- box_inner -->
                    </div><!-- newsbox -->
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