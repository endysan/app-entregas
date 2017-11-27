@extends('template.master')

@section('title', 'Perfil')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('css/ratings.css') }}">
@endsection

@section('content')
<div class="row p-4 mt-4">
    <div class="col-4">
        <h1 class="titulo">Wenndy Sandy</h1>
        <img src="{{ asset('storage/avatar/user_icon.png') }}" height="256" width="256">
    </div>
    <div class="col-5 mt-4">
        <h2 class="titulo">Informações do usuário</h2>
        <p><i class="fa fa-envelope-open-o fa-fw" aria-hidden="true"></i>wenndy@email.com</p> 
        <p><i class="fa fa-phone fa-fw" aria-hidden="true"></i>(13) 3505-5555</p>
        <p>
            <span></span>
            <i class="fa fa-whatsapp fa-fw" aria-hidden="true" style="color: #01C501"></i>
            <span>(13) 99797-9797</span>
        </p>
        <p>
            <span class="text-muted">Membro desde:</span><br/>
            <i class="fa fa-clock-o fa-fw"></i>
            <span>23/04/2017</span>
        </p>
    </div>
    <div class="col-3 mt-4">
        <p>
            <i class="fa fa-line-chart fa-fw"></i>
            <span>Classificação</span>
            <div class="rating">
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
            </div>
        </p>
    </div>
        
</div>
@endsection