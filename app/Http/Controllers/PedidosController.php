<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;

class PedidosController extends Controller 
{
    public function listPedido()
    {
        $pedidos = Pedido::all();
        //$deletedUsers = User::onlyTrashed()->get();
        return view('crud.pedido')->with('pedidos', $pedidos);
    }
    
    public function createPedido(Request $request)
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

        return redirect()->action('PedidosController@listPedido');
    }

    public function editPedido(Request $request, $id)
    {
        DB::table('users')
            ->where('id_pedido', $id)
            ->update([
                'produto' => $request->nome,
                'descricao' => $request->email,
                'estado' => $request->estado,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro
        ]);

        return "ok";
        // $pedido = Pedido::findOrFail($id);
        
        // if($request->produto != null)
        //     $pedido->produto = $request->produto;
            
        // if($request->descricao != null)
        //     $pedido->descricao = $request->descricao;
        
        // if($request->estado != null)
        //     $pedido->estado = $request->estado;
            
        // if($request->cidade != null)
        //     $pedido->cidade = $request->cidade;

        // if($request->bairro != null)
        //     $pedido->bairro = $request->bairro;

        // $pedido->save();
        // return redirect()->action('PedidosController@listPedido');
    }
    
    public function deletePedido($id)
    {
        DB::table('pedidos')->where('id_pedido','=', $id)->delete();
        
        return "ok";
    }
}