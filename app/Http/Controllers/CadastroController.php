<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Entregador;
use App\User;

class CadastroController extends Controller 
{
	public function __construct()
	{
		if(!auth()->check()){
			return redirect('/');
		}
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

		if($request->ajax()){
			return "ok";
		}
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
		
		return view('usuario.editar');
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

	public function editarSenhaView() //SOMENTE PARA ABRIR PAGINA
	{
		return view('usuario.editar-senha');
	}

	//SOMENTE QUANDO CHAMAR POST
	public function editarSenha(Request $request)
	{
		$this->validate($request, [
			'oldpassword' => 'required|min:6',
			'password' => 'required|confirmed|min:6'
		]);
		
		$id = auth()->user()->id;
		
		$usuario = User::findOrFail($id);
		$old = bcrypt(request('oldpassword'));
		
		
		if (auth()->attemp(['email' => auth()->user()->email, 'password' => $old]))
		{
			$newPass = bcrypt($request->password);
			
			$usuario->password = $newPass;

			$usuario->save();
		}
	}

	public function areaEntregador()
	{
		$id = auth()->user()->id;
		
		$entregador = DB::table('entregadores')->where('id_usuario', $id)->first();

		$data = [
			'entregador' => $entregador
		];
		//dd($data);
		return view('usuario.area-entregador')->with(['entregador' => $entregador]);
	}

	public function createEntregador(Request $request)
	{
		$id = auth()->user()->id;

		$entregador = DB::table('entregadores')->insert([
			'id_usuario' => $id,
			'veiculo' => $request->veiculo,
			'cnh' => $request->cnh
		]);

		return redirect('/areaentregador');
	}
}
