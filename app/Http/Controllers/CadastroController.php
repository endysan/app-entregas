<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CadastroController extends Controller 
{
	public function index() 
	{
		$data = ['title' => 'Cadastrar'];
		return view('usuario.cadastro', $data);
	}
	
	public function store(Request $request) 
	{
		// Validando 
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required',
			'password' => 'required|confirmed'
		]);

		$user = User::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => bcrypt(request('password'))
		]);


    	return redirect()->home();
	}
	
	public function editar(Request $request) 
	{

		$id = auth()->user()->id; //ID do usuario, recuperado pela sessão
		
		$usuario = User::findOrFail($id); //Encontre no Model User, o id

		if ( request('name') != null){
			$usuario->name = $request->name;
		}
		if ( request('txt_dt_nasc') != null){
			$usuario->dt_nasc = $request->txt_dt_nasc;
		}
		if ( request('txt_telefone') != null){
			$usuario->telefone = $request->txt_telefone;
		}
		if ( request('txt_whatsapp') != null){
			$usuario->whatsapp = $request->txt_whatsapp;
		}
		
		$usuario->save();
		
		auth()->logout();
		auth()->loginUsingId($id);
		
		$data = [
			'title' => 'Editar Perfil'	
		];
		return view('usuario.editar', $data);
	}
	
	public function editarEndereco()
	{
		return view('usuario.editar-endereco');
	}

	public function passwordReset()
	{
		return view('usuario.editar-senha');
	}
}
