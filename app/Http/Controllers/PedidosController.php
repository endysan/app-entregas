<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;

class PedidosController extends Controller 
{
    public function index()
    {
        $data = ['title' => 'Pedidos'];
        return view('pedidos.index', $data);
    }
    
    public function criar(Request $request)
    {
        $this->validate($request, [
			'produto' => 'required',
			'descricao' => 'required',
			'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required'
		]);

		$pedido = Pedido::create([
			'produto' => request('produto'),
			'descricao' => request('descricao'),
			'estado' => request('estado'),
            'cidade' => request('cidade'),
            'bairro' => request('bairro')
		]);


    	return redirect()->home();
    }    
    
}