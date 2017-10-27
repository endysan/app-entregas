<?php

namespace App\Http\Controllers;

use App\CategoriaPedido;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function login()
    {
        return view('login');
    }
    public function signup()
    {
        return view('signup');
    }
    public function dashboard()
    {
        $this->middleware('auth');
        return view('cliente.dashboard');
    }
    public function createPedido()
    {
        $categorias = CategoriaPedido::select('nome')->get();
        return view('cliente.create_pedido', compact('categorias'));
    }
}
