@extends('ver2.template.master')
@section('title', 'Dashboard')

@section('content')
<section id="section_dashboard">
    <div id="section_inner" class="row">
        <div class="col-md-4 col-12">
            Quantos em espera para entrega
        </div>    
        <div class="col-md-4 col-12">
            Quantos pedidos solicitados
        </div>
        <div class="col-md-4 col-12">
            Quantos concluidos
        </div>
    </div>
</section>
@endsection