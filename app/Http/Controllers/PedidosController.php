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
        return view('ver2.create_pedido');   
    }
    
    public function selectPedidos()
    {
        $pedidos = DB::table('pedidos')->whereNotIn('status', ['cancelado'])->orderBy('created_at', 'ASC')->get();
        $cancelados = DB::table('pedidos')->where('status', ['cancelado'])->orderBy('created_at', 'ASC')->get();
        $users = DB::table('users')->select('id', 'email')->get();
        $data = [
            'pedidos' => $pedidos,
            'cancelados' => $cancelados,
            'users' => $users
        ];
        return $data;
    }

    public function getPedidoById($id)
    {
        if(auth()->check()) {
            return view('ver2.pedido')->with([
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
        $pedidosUsuario = DB::table('pedido')->where([
            ['id_usuario', $userId],
            ['status', '!=', 'cancelado'],
        ])->get();
        $pedidosCancelados = DB::table('pedido')->where([
            ['id_usuario', $userId],
            ['status', '=', 'cancelado'],
        ])->get();

        $data = [
            'pedidos' => $pedidosUsuario,
            'cancelados' => $pedidosCancelados
        ];

        return $data;
    }
    public function listPedido()
    {
        return view('crud.pedido', $this->selectPedidos());
    }
    public function allPedidos()
    {
        return view('pedidos.lista', $this->selectPedidos());
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
            'dt_entrega' => $date,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
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
                'email' => $request->email,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
            DB::table('pedidos')
            ->where('id', $request->id_pedido)
            ->update([
                'status' => 'confirmaçao',
                'updated_at' => Carbon::now(),
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
                'dt_entrega' => $date,
                'updated_at' => Carbon::now(),
        ]);

        return "ok";
       
    }
    
    public function deletePedido($id)
    {
        //DB::table('pedidos')->where('id', $id)->delete();

        DB::table('pedidos')->where('id', $id)->update([
            'status' => 'Cancelado',
            'updated_at' => Carbon::now(),
        ]);
        //return "[PedidosController] Delete - OK";
        return "ok";
    }
}