<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
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
        if(auth()->check()) {
            return view('pedidos.pedido')->with(['pedido' => Pedido::find($id)]);
        }
        return redirect('/login');
        
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
        $validator = Validator::make($request->all(), [
			'id_usuario' => 'required',
			'produto' => 'required',
			'descricao' => 'required',
			'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'dt_entrega' => 'required' // ?
        ],['required' => ':attribute é um campo obrigatório']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $date = $request->dt_entrega;
			
		$formated_date = str_replace('/', '-', $date);
		
		$date = date('Y-m-d', strtotime($formated_date));

        DB::table('pedidos')->insert([
            'id_usuario' => $request->id_usuario,
            'produto' => $request->produto,
            'descricao' => $request->descricao,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'dt_entrega' => $date
        ]);

        if(auth()->check())
            return redirect('/');

        return redirect('/list-pedido');
    }

    public function editPedido(Request $request, $id)
    {
        $date = $request->dt_entrega;
			
		$formated_date = str_replace('/', '-', $date);
		
		$date = date('Y-m-d', strtotime($formated_date));

        DB::table('pedidos')
            ->where('id', $id)
            ->update([
                'produto' => $request->produto,
                'id_usuario' => $request->id_usuario,
                'descricao' => $request->descricao,
                'estado' => $request->estado,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro,
                'dt_entrega' => $date
        ]);

        return "ok";
       
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