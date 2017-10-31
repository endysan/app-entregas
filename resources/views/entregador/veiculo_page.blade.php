@extends('template.master')

@section('title', 'Gerenciar Veículos')

@section('css')
<style>
    .no-veiculos {
        text-align: center;
        padding: 150px;
        margin: 0 auto;
        font-size: 24px;
        color: #888;
    }
    #tipo_veiculo_section label > input {
        visibility: hidden;
        position: absolute;
    }
    #tipo_veiculo_section label > input + i {
        cursor: pointer;
        color: rgb(140,141,142);
        border: 2px solid transparent;
        padding: 10px 12px;
        border-radius: 7px;
    }
    #tipo_veiculo_section label > input:checked + i{
        color: rgb(40,41,42);
        border: 2px solid rgb(40,40,40); 
    }
    #tipo_veiculo_section label > p {
        text-align: center;
    }
    form {
        background-color: white;
        border: 1px solid rgba(140,141,142, 0.4);
    }
</style>
@endsection

@section('content')
<section id="section_veiculo">

    <!-- ==== Exibe veiculo cadastrado do entregador === -->
    @if(count($veiculos) >= 1)
    <div class="row">
        <div class="offset-3 col-6">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Renavam</th>
                <th>Categoria</th>
            </tr>
        @foreach($veiculos as $veiculo)
            <tr>
                <p>{{ $veiculo->id }}</p>
                <p>{{ $veiculo->marca }}</p>
                <p>{{ $veiculo->placa }}</p>
                <p>{{ $veiculo->renavam }}</p>
            <tr>
        @endforeach
        </table>    
        </div>
    </div>
        
    @else 
        <div class="no-veiculo mx-auto p-5">
            <div class="text-muted text-center" style="font-size: 24px;">
                <p>Você ainda não tem veículos cadastrados</p>
                <p>(;-;)</p>
            </div>
        </div>
    @endif
    <div class="">
        <form action="" method="POST" class="p-4 ml-5 mr-5">
            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" class="form-control" id="placa" name="placa" placeholder="xxx-xxxx" max-length="8" required>
            </div>
            <div class="form-group">
                <label for="renavam">Renavam</label>
                <input type="text" class="form-control" id="renavam" name="renavam" placeholder="000000000" max-length="9" required>
            </div>

            <div id="tipo_veiculo_section" class="form-group">
                <p>Categoria do veículo</p>
                <label for="radio_moto">
                    <input type="radio" name="tipo_veiculo" value="moto" id="radio_moto">
                    <i class="fa fa-motorcycle fa-lg" style="font-size: 38px"></i>
                    <p>Moto</p>
                </label>
                <label for="radio_carro">
                    <input type="radio" name="tipo_veiculo" value="carro" id="radio_carro">
                    <i class="fa fa-car fa-lg" style="font-size: 38px"></i>
                    <p>Carro</p>
                </label>
                <label for="radio_caminhao">
                    <input type="radio" name="tipo_veiculo" value="caminhao" id="radio_caminhao">
                    <i class="fa fa-truck fa-lg" style="font-size: 38px"></i>
                    <p>Caminhão</p>
                </label>
            </div>
            <button type="submit" class="btn btn-light text-dark mt-5" style="border: 1px solid #888">Cadastrar veículo</button>
        </form>
    </div>
    
    <!-- === Fim listagem dos veiculos do entregador === -->

</section>
@endsection