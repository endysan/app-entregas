@extends('ver2/template/master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ url('css/ver2/historico_pedidos.css') }}">
@endsection

@section('content')
    

        <section id="section-pedidos">
        <div class="section-inner">
            <h3 class="text-muted"><span class="fa fa-truck fa-fw"></span>Todos os pedidos</h3>

            <div class="sk-folding-cube" id="loading-cube" style="display: none;">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>

            <div id="news_box_wrap" class="">
                @if(isset($pedidos))
                @foreach ($pedidos as $pedido)
                    <div id="" class="news_box">
                        <a href="{{ url('pedido') . '/' . $pedido->id }}">
                            <figure>
                                <img src="img/placeholder.png">
                                <div id="" class="figure_read">
                                    Mais detalhes
                                </div>
                            </figure>
                        </a>
                        <div id="" class="box_inner">
                            <div id="" class="contents">
                                <h3 class="ellipsis">{{ $pedido->produto }}</h3>
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
                    <div class="no-pedidos">
                        <p>Você ainda não fez pedidos</p>
                        <p>(;-;)</p>
                        <a class="btn btn-default bg-appentrega text-light">Fazer pedido</a>
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