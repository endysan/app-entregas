<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsuariosController extends Controller 
{
    public function getUsuarios()
    {
        return User::all();
    }
    public function getUsuarioById($id)
    {
        return User::findOrFail($id);
    }
    
    public function listUsuario()
    {
        $users = $this->getUsuarios();
        //$deletedUsers = User::onlyTrashed()->get();
        return view('crud.usuario')->with('users', $users);
    }
    
    public function createUsuario(Request $request)
    {
        $this->validate($request, [
			'nome' => 'required',
			'email' => 'required',
			'senha' => 'required'
		]);

		$user = User::create([
			'name' => request('nome'),
			'email' => request('email'),
			'password' => bcrypt(request('senha')),
            'dt_nasc' => request('dt_nasc'),
            'estado' => request('estado'),
            'cidade' => request('cidade'),
            'bairro' => request('bairro')
		]);
        return redirect()->action('UsuariosController@listUsuario');
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
        return redirect()->action('UsuariosController@listUsuario');
    }
    
    public function deleteUsuario($id)
    {
        $user = User::findOrFail($id);
        
        $user->where('id', $id)->delete();

        return redirect()->action('UsuariosController@listUsuario');
    }
}
