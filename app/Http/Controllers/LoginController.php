<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        //
    }
    
    public function enter(Request $request) 
    {
        if( auth()->attempt(request(['email', 'password'])) )
        {
            return redirect('dashboard');    
        }
        $errors = 'Por favor verifique seu Email ou Senha';
        return redirect('login')->with('errors', $errors);
    }

    public function destroy()
    {
    	auth()->logout();

        return redirect('index');
    }
}
