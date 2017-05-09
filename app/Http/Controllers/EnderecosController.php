<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EnderecosController extends Controller
{
    public function listEnderecos()
    {
        if(session()->has('admin')) {
            // LOGICA AQUI
            $users = DB::table('users')->get();
            $enderecos = DB::table('enderecos')->get();

            return view('crud.enderecos')->with([
                'enderecos' => $enderecos,
                'users' => $users
                ]);
        }
        return redirect('/login-admin');
    }

    public function createEndereco(Request $request)
    {
        DB::table('enderecos')->insert([
            'identificacao' => $request->identificacao,
            'id_usuario' => $request->id_usuario,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro
        ]);

        return redirect('/list-endereco');
    }
}
