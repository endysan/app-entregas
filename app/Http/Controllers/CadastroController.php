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
		if(!request()->is('cadastro')) { // se a pagina não é de cadastro
			
			if(!auth()->check()) {
				return redirect('/login');
			}
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
	public function editarIndex()
	{
		if(auth()->check())
			return view('usuario.editar');
		
		return redirect('/login');
	}
	public function editar(Request $request = null) 
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

			return redirect('/editar');
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
			'oldpassword' => 'required',
			'password' => 'required|confirmed'
		]);
		
		$id = auth()->user()->id;
		
		$usuario = User::findOrFail($id);
		$old = request('oldpassword');
		
		
		if (auth()->attempt(['email' => auth()->user()->email, 'password' => $old]))
		{
			
			$newPass = bcrypt($request->password);

			User::where('id', $id)->update(['password' => $newPass]);
			
			return redirect('/editar');
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
