<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CrudController extends Controller 
{
    public function loginView(){
      return view('crud.login');
    }
    
    public function login(Request $request){
        $email=$request->email;
        $senha=$request->senha;
        if ($email=='admin' && $senha=='admin'){
            return view('crud.links');
            
        }
        return back()->withError([
            'message'=> 'Email ou senha incorreto'    
        ]);
        
    }
}
