<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        $data = ['title' => 'Login'];
        return view('login', $data);
    }
    
    public function enter(Request $request) 
    {
        if( auth()->attempt(request(['email', 'password'])) )
        {
            if(session()->has('admin')) {
                session()->forget('admin');
            }
            return redirect()->home();    
        }
        return back()->withErrors([
            'message' => 'Por favor verifique seu Email ou Senha'
        ]);
        
    }

    public function destroy()
    {
    	auth()->logout();

        return redirect()->home();
    }
}
