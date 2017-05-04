<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CrudController extends Controller 
{
    public function loginView(){
      return view('crud.login');
    }
    
    public function login(Request $request)
    {
        $email = $request->email;
        $senha = $request->senha;
        if ($email=="admin@email.com" && $senha=="admin"){
            session(['admin' => 'logado']);
            return redirect()->action('CrudController@list');
        }
        return back()->withErrors([
            'message'=> 'Email ou senha incorreto'
        ]);
    }

    public function list()
    {
        return view('crud.link');
    }
    public function logout()
    {
        session()->forget('admin');
        return redirect()->home();
    }
}
