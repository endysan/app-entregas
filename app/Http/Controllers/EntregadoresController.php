<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntregadoresController extends Controller
{
    public function getEntregadores()
    {
        return Entregador::all();
    }
    public function getEntregadorById($id)
    {
        return Entregador::findOrFail($id);
    }
    
    public function listEntregadores()
    {
        $entregadores = $this->getEntregadores();
        //$deletedUsers = User::onlyTrashed()->get();
        return view('crud.entregador')->with('entregadores', $entregadores);
    }
    
    public function createEntregador(Request $request)
    {
        $this->validate($request, [
			'nome' => 'required',
			'email' => 'required',
			'senha' => 'required'
		]);

		$entregador = Entregador::create([
			'name' => request('nome'),
			'email' => request('email'),
			'password' => bcrypt(request('senha')),
            'dt_nasc' => request('dt_nasc'),
            'estado' => request('estado'),
            'cidade' => request('cidade'),
            'bairro' => request('bairro')
		]);
        return redirect()->action('EntregadoresController@listEntregadores');
    }

    public function editUsuario(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if($request->name != null)
            $user->name = $request->name;
            
        if($request->dt_nasc != null)
            $user->name = $request->dt_nasc;
        
        if($request->telefone != null)
            $user->telefone = $request->telefone;
            
        if($request->whatsapp != null)
            $user->whatsapp = $request->whatsapp;
        
        $user->save();
        return redirect()->action('EntregadoresController@listEntregadores');
    }
    
    public function deleteEntregador($id)
    {
        $entregador = Entregador::findOrFail($id);
        
        $entregador->where('id', $id)->delete();

        return redirect()->action('EntregadoresController@listEntregadores');
    }
}
