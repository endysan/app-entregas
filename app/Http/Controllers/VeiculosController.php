<?php

namespace App\Http\Controllers;

use App\Veiculo;
use Illuminate\Http\Request;

class VeiculosController extends Controller
{
    //
    public function index()
    {
        $veiculos = $this->getVeiculosEntregador();
        return view('entregador.veiculo_page', compact('veiculos'));
    }

    public function getVeiculosEntregador()
    {
        return Veiculo::where('entregador_id', auth()->user()->id)->get();
    }

    public function getVeiculos()
    {
        return Veiculo::all();
    }
    public function postCreateVeiculo(Request $request)
    {
        $veiculo = new Veiculo();
        $veiculo->placa = $request->placa;
        $veiculo->renavam = $request->renavam;
        $veiculo->tipo_veiculo = $request->tipo_veiculo;
    }
}
