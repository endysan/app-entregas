@extends('template.master')

@section('title', 'Perfil')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('css/ratings.css') }}">
@endsection

@section('content')
<div class="row p-4 mt-2">
    <div class="col-md-4 col-12">
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
            <input type="file" id="img" name="img_perfil" onchange="form.submit()" class="inputfile"/>
        </form>
        @endif
    </div>

    <div class="col-md-5 col-12 mt-2">
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
    <div class="col-md-3 col-12 mt-2">
        <p>
            <i class="fa fa-line-chart fa-fw"></i>
            <span>Classificação</span>
            <div class="classificacao">
                        <!-- codigo -->
                <?php 
                $class = new App\Http\Controllers\ClienteController();
                $value = $class->getClassificacao($cliente->entregador->id);
                $whiteStars = 5 - $value;
                ?>
                @for($i = 0; $i < $value; $i++)

                    <i class="fa fa-star"></i>
                @endfor
                
                @for($i = 0; $i < $whiteStars; $i++)
                    <i class="fa fa-star-o"></i>
                @endfor
            </div>
        </p>
        <p>
                <i class="fa fa-vcard fa-fw"></i><span> Veiculos<span><br><br>
                @foreach($cliente->entregador->veiculo as $veiculo)
                    @if($veiculo->categoria_veiculo == 'moto')
                        <p class="ml-2"><i class="fa fa-motorcycle fa-lg ml-2" style="font-size: 38px; margin-right: 10px;"></i>Moto</p>
                    @elseif($veiculo->categoria_veiculo == 'carro')
                        <p class="ml-2"><i class="fa fa-car fa-lg ml-2" style="font-size: 38px; margin-right: 10px;"></i>Carro</p>
                    @elseif($veiculo->categoria_veiculo == 'caminhao')
                        <p class="ml-2"><i class="fa fa-truck fa-lg ml-2" style="font-size: 38px; margin-right: 10px;"></i>Caminhão</p>
                    @endif
                @endforeach
        </p>
    </div>
    @endif
</div>
@endsection

@section('script')

@endsection