<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Entregador;
use App\User;

class EntregadoresController extends Controller
{
    public function getEntregador()
    {
        return Entregador::all();
    }
    public function getEntregadorById($id)
    {
        return Entregador::findOrFail($id);
    }
    
    public function listEntregador()
    {
        $entregadores = $this->getEntregador();
        
        $users = DB::table('users')->select('id', 'email')->get();
        
        //$deletedUsers = User::onlyTrashed()->get();
        
        $data = [
            'entregadores' => $entregadores,
            'users' => $users,
        ];
        return view('crud.entregador', $data);
    }
    
    public function createEntregador(Request $request)
    {
        $this->validate($request, [
			'email_id' => 'required',
			'cnh' => 'required|min:10|max:10',
		]);

        DB::table('entregadores')->insert(
            ['id_usuario' => $request->email_id, 'cnh' => $request->cnh]
        );
		
		dd($request->all());
        //return redirect('list-entregador');
    }

    public function editEntregador(Request $request, $id)
    {
        DB::table('entregadores')
            ->where('id', $id)
            ->update([
                'cnh' => $request->cnh,
                'status' => $request->status
            ]);
        return "ok";
    }
    
    public function deleteEntregador($id)
    {
        DB::table('entregadores')->where('id', '=', $id)->delete();

        return "ok";
    }
}
