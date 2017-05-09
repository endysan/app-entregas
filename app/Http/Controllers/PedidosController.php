<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pedido;

class PedidosController extends Controller 
{
    public function __construct()
    {
        if(!session()->has('admin')) {
            if(!auth()->check()) {
                return redirect('/login');
            }
            return redirect('/login-admin');
        }
    }

    public function index()
    {
        return view('pedidos.index');   
    }
    
    public function getPedidoById($id)
    {
        return Pedido::findOrFail($id);
        
    }
    public function getPedidoByUser($userId)
    {
        $pedidosUsuario = DB::table('pedido')->where('id_usuario', $userId)-get();
        
        dd($pedidosUsuario);
    }
    public function listPedido()
    {
        $pedidos = Pedido::all();
        $users = DB::table('users')->select('id', 'email')->get();
        $data = [
            'pedidos' => $pedidos,
            'users' => $users
        ];
        //$deletedUsers = User::onlyTrashed()->get();
        return view('crud.pedido', $data);
    }
    
    public function createPedido(Request $request)
    {
        $this->validate($request, [
            'id_usuario' => 'required',
			'produto' => 'required',
			'descricao' => 'required',
			'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required'
		]);


        DB::table('pedidos')->insert([
            'id_usuario' => $request->id_usuario,
            'produto' => $request->produto,
            'descricao' => $request->descricao,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro
        ]);

        if(auth()->check())
            return redirect('/');

        return redirect('/list-pedido');
    }

    public function editPedido(Request $request, $id)
    {
        DB::table('pedidos')
            ->where('id', $id)
            ->update([
                'produto' => $request->produto,
                'id_usuario' => $request->id_usuario,
                'descricao' => $request->descricao,
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
        //DB::table('pedidos')->where('id', $id)->delete();

        DB::table('pedidos')->where('id', $id)->update([
            'status' => 'Cancelado'
        ]);
        //return "[PedidosController] Delete - OK";
        return "ok";
    }
}