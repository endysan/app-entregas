<?php

namespace App\Http\Controllers;

use App\Veiculo;
use Illuminate\Http\Request;

class VeiculosController extends Controller
{
    //
    public function index()
    {
        $veiculos = Veiculo::where('entregador_id', auth()->user()->entregador_id)->get();
        return view('entregador.veiculo_page', compact('veiculos'));
    }


    public function getVeiculos()
    {
        return Veiculo::all();
    }
    public function removeVeiculo($id)
    {
        $veiculo = Veiculo::find($id);
        $veiculo->delete();
    }

    public function postCreateVeiculo(Request $request)
    {
        $veiculo = new Veiculo();
        $veiculo->placa = $request->placa;
        $veiculo->renavam = $request->renavam;
        $veiculo->tipo_veiculo = $request->tipo_veiculo;
        $veiculo->entregador_id = $request->entregador_id;
        $veiculo->save();

        if(isset($request->img)){
            $path = $request->img->storeAs(
                'uploads/veiculo',
                ImagemController::formatImageName('veiculo', $request->img)
            );
            $image = new Imagem();
            $image->local_imagem = $path;
            $image->veiculo_id = $veiculo->id;
        }
        return redirect('entregador/veiculos');
    }
}
