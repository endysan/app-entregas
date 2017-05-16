<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrega;
use App\Pedido;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        $entregas = Entrega::all();

        foreach($pedidos as $pedido){
            $entrega = $entregas->where('id_pedido', $pedido->id);
        }

        $entrega = Entrega::where('id_pedido')->first();

        $data = [
            'title' => 'Home',
            'content' => 'AppEntrega',
            'pedidos' => $pedidos,
            'entrega' => $entrega
        ];
        return view('home', $data);
    }
}
