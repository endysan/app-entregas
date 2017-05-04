<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EntregasController extends Controller
{
    //
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
            'dt_entrega' => 'required|min:10|max:10'
		]);
        
        $date = $request->dt_entrega;
			
		$formated_date = str_replace('/', '-', $date);
		
		$date = date('Y-m-d', strtotime($formated_date));
        DB::table('entregas')->insert([
            'id_pedido' => $request->id_pedido,
            'id_entregador' => $request->id_entregador,
            'dt_entrega' => $date
        ]);
		
		//dd($request->all());
        return redirect('list-entrega');
    }

    public function editEntrega(Request $request, $id)
    {
        DB::table('entregas')
            ->where('id', $id)
            ->update([
                'id_pedido' => $request->id_pedido,
                'id_entregador' => $request->id_entregador,
                'dt_entrega' => $request->dt_entrega
            ]);
        return "ok";
    }
    
    public function deleteEntrega($id)
    {
        DB::table('entregas')->where('id', $id)->delete();

        return "ok";
    }
}
