<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Endereco;
use App\Entregador;
use App\EntregadorClassificacao;

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
        $cliente = Cliente::find($request->cliente_id);
        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;
        $cliente->whatsapp = $request->whatsapp;
        
        //ESPECIFICO DE ENTREGADOR
        $cliente->entregador->cpf = $request->cpf;
        $cliente->entregador->cnh = $request->cnh;

        $cliente->save();

        // ENDEREÇO
        $endereco = new Endereco();
        $endereco->cep = $request->cep;
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->estado = $request->uf;
        $endereco->entregador_id = $cliente->entregador->id;
        $endereco->save();

        return redirect('entregador/editar');
    }

    public function getClassificacao($id)
    {
        $classificacao = DB::table('entregador_classificacao')->where('entregador_id', $id)->avg('avaliacao');

        return $classificacao;
    }
}
