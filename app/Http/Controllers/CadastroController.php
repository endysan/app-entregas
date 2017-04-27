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

		$teste= User::find(Auth::user()->id)

		if ( request('name') != null){
		$teste->name = request('name');
		}
		if ( request('txt_dt_nasc') != null){
		$teste->dt_nasc = request('txt_dt_nasc');
		}
		if ( request('txt_telefone') != null){
		$teste->telefone = request('txt_telefone');
		}
		if ( request('tct_whatsapp') != null){
		$teste->whatsapp = request('txt_whatsapp');
		}
		
		$teste->save();

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
