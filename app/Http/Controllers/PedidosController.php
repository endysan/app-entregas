<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\PedidoHasEntregadores;
use App\Entrega;
use App\Pedido;
use App\User;

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
            return view('pedidos.pedido')->with([
                'user' => User::find(auth()->user()->id),
                'pedido' => Pedido::find($id),
                'entrega' => Entrega::where('id_pedido', $id)->first(),
                'aceitos' => PedidoHasEntregadores::where('id_pedido', $id)->get(),
            ]);
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
        $formated_date = str_replace('/', '-', $request->dt_entrega);
        if(!strtotime($formated_date)){
            session()->flash('errorMessage', 'formato de data incorreta');
            return redirect()->back();
        }
		$date = Carbon::parse($formated_date)->format('Y-m-d');

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

    public function addEntregador(Request $request)
    {
        try {
            $aceito = DB::table('pedido_has_entregadores')->insertGetId([
                'id_pedido' => $request->id_pedido,
                'id_entregador' => $request->id_entregador,
                'email' => $request->email
            ]);
            
            DB::table('pedidos')
            ->where('id', $request->id_pedido)
            ->update([
                'status' => 'confirmaçao'
            ]);
            return redirect('/pedido/'.$request->id_pedido);
        }
        catch (PDOException $ex)
        {
            Session::flash('errorMessage', 'Erro ao realizar essa ação');
        }
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