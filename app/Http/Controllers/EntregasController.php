<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EntregasController extends Controller
{
    //
    public function __construct()
    {
        if(!session()->has('admin')) {
            if(!auth()->check()) {
                return redirect('/login');
            }
            return redirect('/login-admin');
        }
    }
    public function getEntrega()
    {
        return DB::table('entregas')->get();
    }
    public function getEntregaById($id)
    {
        return DB::table('entregas')->where('id', $id)->get();
    }
    
    public function listEntrega()
    {
        $entregas = $this->getEntrega();

        $pedidos = DB::table('pedidos')->select('id', 'produto')->get();

        $entregadores = DB::table('entregadores')
            ->join('users', 'users.id', '=', 'entregadores.id_usuario')
            ->select('entregadores.id', 'entregadores.id_usuario', 'users.email')->get();
        
        $data = [
            'entregas' => $entregas,
            'pedidos' => $pedidos,
            'entregadores' => $entregadores,
        ];
        return view('crud.entrega', $data);
    }
    
    public function createEntrega(Request $request)
    {
        $this->validate($request, [
			'id_pedido' => 'required',
			'id_entregador' => 'required',
		]);
        
        try {
            DB::table('entregas')->insert([
                'id_pedido' => $request->id_pedido,
                'id_entregador' => $request->id_entregador,
            ]);

            if($request->is('list-entrega')) {
                return redirect('list-entrega');
            }
            
            session()->flash('success', 'Pedido aceito, aguarde a confirmação');
            return redirect('/');
            
        } catch(PDOException $ex) {
            session()->flash('errorMessage', 'Problemas ao aceitar esse pedido');
            return redirect()->back();
        }
		
		//dd($request->all());
        
    }

    public function editEntrega(Request $request, $id)
    {
        DB::table('entregas')
            ->where('id', $id)
            ->update([
                'id_pedido' => $request->id_pedido,
                'id_entregador' => $request->id_entregador,
            ]);
        return "ok";
    }
    
    public function deleteEntrega($id)
    {
        DB::table('entregas')->where('id', $id)->delete();

        return "ok";
    }
}
