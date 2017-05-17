<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Entregador;
use Validator;
use App\User;

class CadastroController extends Controller 
{
	public function __construct()
	{	
		if(!request()->is('cadastro') && !auth()->check()) { // se a pagina não é de cadastro
			return redirect('/login');
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
		
		$checkUser = User::where('email', $request->email)->get();

		if(!$checkUser->isEmpty())
		{
			session()->flash('errorMessage', 'Email já cadastrado');
			return redirect()->back();
		}

		$user = User::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => bcrypt(request('password'))
		]);
		session()->flash('success', 'Cadastrado com sucesso');
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

			if ( $request->name != null){
				$usuario->name = $request->name;
			}
			if ( $request->dt_nasc != null && strlen($request->dt_nasc) == 10){
				$formated_date = str_replace('/', '-', $request->dt_nasc);
				//$usuario->dt_nasc = date('Y-m-d', strtotime($formated_date));
				$date = Carbon::parse($formated_date)->format('Y-m-d');
				$usuario->dt_nasc = $date;
			}
			if ( $request->telefone != null && strlen($request->telefone) == 14){
				$usuario->telefone = $request->telefone;
			}
			if ( $request->whatsapp != null && strlen($request->whatsapp) == 15){
				$usuario->whatsapp = $request->whatsapp;
			}
			
			$usuario->save();
			
			auth()->logout(); 
			auth()->loginUsingId($id);

			return redirect('/editar');
	}
	
	public function editarEnderecoView()
	{
		if(auth()->check())
			return view('usuario.editar-endereco');
		
		return redirect('/login');
	}
	public function editarEndereco(Request $request)
	{
		$id = auth()->user()->id; //ID do usuario, recuperado pela sessão
		
		$usuario = User::find($id); //Encontre no Model User, o id

		$endereco = DB::table('users')->where('id_usuario', $usuario->id)->get();

		if ( $request->estado != null){
			$endereco->estado = $request->estado;
		}
		if ( $request->cidade != null){
			$endereco->cidade = $request->cidade; 
		}
		if ( $request->bairro != null){
			$endereco->bairro = $request->bairro;
		}
		
		try{
			DB::table('users')
				->where('id_usuario', $usuario->id)
				->update([
					'estado' => $endereco->estado,
					'cidade' => $endereco->cidade,
					'bairro' => $endereco->bairro
				]);
		} catch(PDOException $ex) {
			return redirect()->back()->withErrors(['errors' => 'Erro inesperado ao editar']);
		}
		
		auth()->logout(); 
		auth()->loginUsingId($id);
		
		session()->flash('success', 'Editado com sucesso!');
		return redirect('/editarendereco');
	}

	public function editarSenhaView() //SOMENTE PARA ABRIR PAGINA
	{
		if(auth()->check())
			return view('usuario.editar-senha');
		
		return redirect('/login');
	}

	//SOMENTE QUANDO CHAMAR POST
	public function editarSenha(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
			'password' => 'required|confirmed'
        ],
		[
			'required' => ':attribute é um campo obrigatório',
			'confirmed' => 'As senhas não conferem'
		]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

		$id = auth()->user()->id;
		
		$usuario = User::find($id);
		$old = request('oldpassword');
		
		if (auth()->attempt(['email' => auth()->user()->email, 'password' => $old]))
		{
			$newPass = bcrypt($request->password);
			
			User::where('id', $id)->update(['password' => $newPass]);
			
			session()->flash('success', 'Senha modificada com sucesso!');
			return redirect('/editarsenha');
		}
		session()->flash('errorMessage', 'Ocorreu um erro ao modificadar a senha');
		return redirect()->back();
	}

	public function areaEntregador()
	{
		if(auth()->check()){
			$id = auth()->user()->id;
			
			$entregador = DB::table('entregadores')->where('id_usuario', $id)->first();

			$data = [
				'entregador' => $entregador
			];
			return view('usuario.area-entregador')->with(['entregador' => $entregador]);
		}
		return redirect('/login');
	}

	public function createEntregador(Request $request)
	{
		 $validator = Validator::make($request->all(), [
			 //Regras
            'veiculo' => 'required',
			'cnh' => 'required|size:10'
        ],
		[
			//Mensagens
			'required' => ':attribute é um campo obrigatório',
			'size' => ':attribute deve ter o tamanho de :size'
		]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

		$id = auth()->user()->id;
		
		try{
			$entregador = DB::table('entregadores')->insertGetId([
				'id_usuario' => $id,
				'email' => auth()->user()->email,
				'veiculo' => $request->veiculo,
				'cnh' => $request->cnh
			]);
			DB::table('users')
				->where('id', $id)
				->update([
					'id_entregador' => $entregador
				]);
			return redirect('/areaentregador');
			
		} catch (PDOException $ex) {
			
			session()->flash('errorMessage', 'Ocorreu um erro ao se alistar como entregador');
			return redirect()->back();
		}
		
	}
}
