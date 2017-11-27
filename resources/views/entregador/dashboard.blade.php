@extends('template.master')
@section('title', 'Dashboard')
@section('css')
<style>
    #info-section div {
        width: 90%;
        background-color: white;
        min-height: 10rem;
        font-weight: 600;
        color: #444;
    }
    
</style>
@endsection
@section('content')
<section id="section_dashboard">
    <div id="section_inner" class="p-4">
    <div class="row col-12">
        <h2>Olá, Marcelo Henrique</h2>
    </div>

    <div class="row" id="info-section">
            <div class="col-md-4 col-12 p-3 border-appentrega">
                Entregas pendentes<br/>
                <span style="font-size: 32px">0</span>
            </div>    
            <div class="col-md-4 col-12 p-3 border-appentrega">
                Orçamentos em espera<br/>
                <span style="font-size: 32px">0</span>
            </div>
            <div class="col-md-4 col-12 p-3 border-appentrega">
                Entregas finalizadas<br/>
                <span style="font-size: 32px">0</span>
            </div>
    </div>
    </div>
</section>
@endsection