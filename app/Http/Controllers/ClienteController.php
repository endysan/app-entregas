<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    //
    public function postEditar(Request $request)
    {
        $cliente = Cliente::find($request->cliente_id);

        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;
        $cliente->whatsapp = $request->whatsapp;

        $cliente->save();
        return redirect('cliente/editar');
    }

    public function postEditarEntregador(Request $request)
    {
        
    }
}
