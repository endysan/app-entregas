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
	
	public function editar() 
	{
		$data = [
			'title' => 'Editar Perfil'	
		];
		return view('usuario.editar', $data);
	}
}
