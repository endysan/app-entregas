<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GoogleMaps\Facade\GoogleMapsFacade;
use App\Pedido;

class MapaController extends Controller
{
    //
    public function getMarcarEndereco()
    {
        $pedidos = Pedido::where('status_pedido', 'pendente')->get();
        
        $geocoding = [];
        foreach($pedidos as $pedido) {
            $geocoding[] = $this->getLatLng($pedido->estado_origem.','.$pedido->cidade_origem.','.$pedido->bairro_origem);
        }
        $var = ['locais' => $geocoding];
        
        return $var;
    }
    public function getMapa()
    {
        $pedidos = Pedido::where('status_pedido', 'pendente')->get();
        return view('entregador.mapa_pedidos', compact('pedidos'));
    }
    public function getLatLng($localString)
    {
        $latlng = \GoogleMaps::load('geocoding')
            ->setParam([
                'address' => $localString,
                'region' => 'pt-BR'
            ])
            ->get();
        return $latlng;
    }
}
