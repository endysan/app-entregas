@extends('template.master')
@section('title', 'Dashboard')

@section('content')
<section id="section_dashboard">
    <div id="section_inner" class="p-4">
    <div class="row col-12">
        <h2>Cliente, olá {{ App\Cliente::find(Auth::user()->id)->primeiro_nome }}</h2>
    </div>

    <div class="row">
        <div class="col-md-4 col-12" style="border: 1px">
            Quantos em espera para entrega 
        </div>    
        <div class="col-md-4 col-12">
            Quantos pedidos solicitados
        </div>
        <div class="col-md-4 col-12">
            Quantos concluidos
        </div>
    </div>
    </div>
</section>
@endsection