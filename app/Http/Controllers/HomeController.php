<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $data = [
            'title' => 'Home',
            'content' => 'AppEntrega',
            'pedidos' => $pedidos
        ];
        return view('home', $data);
    }
}
