<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PedidosController extends Controller 
{
    public function index()
    {
        $data ['title' => 'Pedidos']
        return view('pedidos.criar', $data);
    }
    
    public function criar(Request $request)
    {
        
    }    
    
}