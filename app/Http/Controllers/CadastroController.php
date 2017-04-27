<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CadastroController extends Controller 
{
	public function __construct()
	{
			
	}
	
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
		if ( request('dt_nasc') != null){

			$date = $request->dt_nasc;
			
			$formated_date = str_replace('/', '-', $date);
			
			$usuario->dt_nasc = date('Y-m-d', strtotime($formated_date));
		}
		if ( request('telefone') != null){
			$usuario->telefone = $request->telefone;
		}
		if ( request('whatsapp') != null){
			$usuario->whatsapp = $request->whatsapp;
		}
		
		$usuario->save();
		
		auth()->logout(); 
		auth()->loginUsingId($id);
		
		$data = [
			'title' => 'Editar Perfil'	
		];
		return view('usuario.editar', $data);
	}
	
	public function editarEndereco(Request $request)
	{
		$id = auth()->user()->id; //ID do usuario, recuperado pela sessão
		
		$usuario = User::findOrFail($id); //Encontre no Model User, o id

		if ( request('estado') != null){
			$usuario->estado = $request->estado;
		}
		if ( request('cidade') != null){
			$usuario->cidade = $request->cidade; 
		}
		if ( request('bairro') != null){
			$usuario->bairro = $request->bairro;
		}
		$usuario->save();
		
		auth()->logout(); //funcionou =D
		auth()->loginUsingId($id);
		
		return view('usuario.editar-endereco');
	}

	public function passwordReset(Request $request)
	{
		$this->validate($request, [
			'oldpassword' => 'required',
			'password' => 'required|confirmed'
		]);
		
		$id = auth()->user()->id;
		
		$usuario = User::findOrFail($id);
		$old = bcrypt(request('oldpassword'));
		
		//Tenta logar, com email do usuario logado
		//
		if (auth()->attemp(['email' => auth()->user()->email, 'password' => $old]))
		{
			$newPass = bcrypt($request->password);
			
			$usuario->password = $newPass;
		}
		return view('usuario.editar-senha');
	}
}
