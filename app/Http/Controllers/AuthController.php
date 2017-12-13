<?php

namespace App\Http\Controllers;

use Validator;
use App\Cliente;
use App\Entregador;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function postLogin(Request $request)
    {
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(auth()->user()->entregador == null){
                return redirect()->route('cliente.home');
            }
            return redirect()->route('entregador.home');
        }
        
        return redirect('login')->withErrors('Email ou senha inválidos')->withInput();
        //response()->json(['status' => 'FAIL'], 401);
    }
    
    public function getLogout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function postSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:60',
            'email' => 'required|unique:cliente|max:60',
            'password' => 'required|confirmed',
            'radioTipoCadastro' => 'required'
        ]);
        
        if($validator->fails()) {
            return redirect('signup')->with(['errors' => $validator])->withInput();
        }
        // Validação passou =============
        $cliente = new Cliente;
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->password = bcrypt($request->password);
        $cliente->save();

        if($request->radioTipoCadastro == 'entregador') {
            
            // Precisa criar registro na tabela entregador
            $entregador = new Entregador;
            $entregador->cliente_id = $cliente->id;
            $entregador->save();
            
        }
        auth()->login($cliente);
        
        if(isset($entregador)){
            return redirect('entregador/editar');    
        }
        else {
            return redirect('cliente/editar');
        }
        
        
    }

    public function imgPerfil(Request $request)
    {
        $cliente = Cliente::find($request->cliente_id);
        if(!empty($request->img_perfil)){
            
            $imgName = ImagemController::formatImageName('avatar', $request->img_perfil);
            $path = $request->file('img_perfil')->storeAs(
                'public/avatar',
                $imgName
            );   
            $cliente->img_perfil = $imgName;
            $cliente->save();
        }
        return redirect()->route('cliente.home');
    }
}
