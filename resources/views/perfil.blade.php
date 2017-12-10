@extends('template.master')

@section('title', 'Perfil')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('css/ratings.css') }}">
@endsection

@section('content')
<div class="row p-4 mt-2">
    <div class="col-4">
        <h1 class="titulo">{{ $cliente->nome }}</h1>
        @if($cliente->img_perfil == null)
            <img src="{{ asset('storage/avatar/user_icon.png') }}" height="256" width="256">
        @else
            <img src="{{ asset('storage/avatar/' . $cliente->img_perfil) }}" class="border-rounded" height="256" width="256">
        @endif

        @if($cliente->id == auth()->user()->id)
        <form action="{{ url('/perfil/upload') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
            <input type="file" id="img" name="img_perfil" onchange="form.submit()" />
        </form>
        @endif
    </div>

    <div class="col-5 mt-2">
        <h2 class="titulo">Informações do usuário</h2>
        <p><i class="fa fa-envelope-open-o fa-fw" aria-hidden="true"></i>{{ $cliente->email }}</p> 
        <p><i class="fa fa-phone fa-fw" aria-hidden="true"></i>{{ $cliente->getTelefone() }}</p>
        <p>
            <span></span>
            <i class="fa fa-whatsapp fa-fw" aria-hidden="true" style="color: #01C501"></i>
            <span>{{ $cliente->getWhatsapp() }}</span>
        </p>
        <p>
            <span class="text-muted">Membro desde:</span><br/>
            <i class="fa fa-clock-o fa-fw"></i>
            <span>{{ Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}</span>
        </p>
    </div>
    @if(isset($cliente->entregador))
    <div class="col-3 mt-2">
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
    @endif
</div>
@endsection

@section('script')

@endsection