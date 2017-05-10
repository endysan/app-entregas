<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use App\User;

class UsuariosController extends Controller 
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
			'senha' => 'required',
            'dt_nasc' => 'required|size:10'
		]);
		
        $date = $request->dt_nasc;
			
		$formated_date = str_replace('/', '-', $date);
		
		$date = date('Y-m-d', strtotime($formated_date));
		
		$user = User::create([
			'name' => $request->nome,
			'email' => $request->email,
			'password' => bcrypt($request->senha),
            'dt_nasc' => $date
        ]);
        return redirect('list-usuario');
    }

    public function editUsuario(Request $request, $id)
    {
        //$user = User::findOrFail($id);
        $date = null;
        if($request->dt_nasc != null){
            $date = $request->dt_nasc;	
            $formated_date = str_replace('/', '-', $date);
            $date = date('Y-m-d', strtotime($formated_date));
        }
        
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->nome,
                'email' => $request->email,
                'dt_nasc' => $date
            ]);
        DB::table('enderecos')
            ->where('id_usuario', $id)
            ->update([
                'estado' => $request->estado,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro
            ]);
        // if($request->nome != null)
        //     $user->name = $request->nome;
    
        // if($request->dt_nasc != null)
        //     $user->name = $request->dt_nasc;
    
        // if($request->telefone != null)
        //     $user->telefone = $request->telefone;
    
        // if($request->whatsapp != null)
        //     $user->whatsapp = $request->whatsapp;
        
        //$user->save();
        //dd($user);
        //dd($request->all());
        return "ok";
    }
    
    public function deleteUsuario($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        //DB::table('users')->where('id', $id)->delete();
        
        return "ok";
    }
}
