<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Disputa;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function __construct()
    {
        //
    }

    public function postCreatePedido(Request $request)
    {
        $pedido = new Pedido();
        
        $pedido->titulo = $request->titulo;
        $pedido->descricao = $request->descricao;
        $pedido->data_entrega = Carbon::createFromFormat('d/m/Y', $request->data_entrega)->toDateString();
        $pedido->periodo_entrega = $request->periodo_entrega;
        $pedido->cep_origem = $request->cep_origem;
        $pedido->logradouro_origem = $request->rua_origem . ', '. $request->numero_origem;
        $pedido->bairro_origem = $request->bairro_origem;
        $pedido->cidade_origem = $request->cidade_origem;
        $pedido->estado_origem = $request->uf_origem;
        $pedido->cep_destino = $request->cep_destino;
        $pedido->logradouro_destino = $request->rua_destino . ', '. $request->numero_destino;
        $pedido->bairro_destino = $request->bairro_destino;
        $pedido->cidade_destino = $request->cidade_destino;
        $pedido->estado_destino = $request->uf_destino;
        $pedido->status_pedido = 1; // AGUARDANDO
        $pedido->cliente_id = auth()->user()->id;
        $pedido->save();

        return redirect()->route('cliente.home');
    }

    public function getPedidos()
    {
        $pedidos = Pedido::where('cliente_id', auth()->user()->id)->get();

        //usar compact('pedidos') é igual a ['pedidos' => $pedidos]
        return view('cliente.historico_pedidos', compact('pedidos'));
    }
    public function getPedidoById($id)
    {
        $pedido = Pedido::find($id);

        return view('pedido_page', compact('pedido'));
    }
}
