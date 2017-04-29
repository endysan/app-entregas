<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsuarioController extends Controller 
{
    
    public function listUser()
    {
        $users = User::all();
        $deletedUsers = User::onlyTrashed()->get();
        
        $data = [
            'users' => $users,
            'deletedUsers' =>$deletedUsers,
        ];
        /
            'password' => 'required|confirmed',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        
        return redirect()->action('UsuarioController@showUser');
    }
    
    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if($request->name != null)
            $user->name = $request->name;
            
        if($request->dt_nasc != null)
            $user->name = $request->dt_nasc;
        
        if($request->telefone != null)
            $user->telefone = $request->telefone;
            
        if($request->whatsapp != null)
            $user->whatsapp = $request->whatsapp;
        
        $user->save();
    }
    
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        $user->where('id', $id)->delete();
    }
}
