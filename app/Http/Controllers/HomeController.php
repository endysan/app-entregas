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
        return view('ver2/index');
    }
    public function login()
    {
        return view('ver2/login');
    }

    public function dashboard()
    {
        return view('ver2/dashboard');
    }
    public function signup()
    {
        return view('ver2/signup');
    }

    public function historico()
    {
        $pedidos = Pedido::where('id_usuario', auth()->id())->get();
        //dd($pedidos->first());
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
        //dd($data);
        return view('ver2/historico_pedidos', $data);
    }
}
