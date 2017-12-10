<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Imagem;
use App\Proposta;
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
        $pedido->categoria_veiculo = $request->categoria_veiculo;
        $pedido->cep_origem = $request->cep_origem;
        $pedido->logradouro_origem = $request->rua_origem . ', nº '. $request->numero_origem;
        $pedido->bairro_origem = $request->bairro_origem;
        $pedido->cidade_origem = $request->cidade_origem;
        $pedido->estado_origem = $request->uf_origem;
        $pedido->cep_destino = $request->cep_destino;
        $pedido->logradouro_destino = $request->rua_destino . ', nº '. $request->numero_destino;
        $pedido->bairro_destino = $request->bairro_destino;
        $pedido->cidade_destino = $request->cidade_destino;
        $pedido->estado_destino = $request->uf_destino;
        $pedido->status_pedido = Pedido::$statusPedido['pendente']; // arquivo raiz/config/enum.php
        $pedido->cliente_id = auth()->user()->id;
        $pedido->save();

        if(!empty($request->img)){
            $imgName = ImagemController::formatImageName('pedido', $request->img);
            $path = $request->file('img')->storeAs(
                'public/pedido',
                $imgName
            );
            
            $pedido->img_pedido = $imgName;
            $pedido->save();
        }
        
        return redirect()->route('cliente.pedido', ['id' => $pedido->id]);
    }

    public function getPedidos()
    {
        $pedidos = Pedido::where('cliente_id', auth()->user()->id)->get();
        
        //usar compact('pedidos') é igual a ['pedidos' => $pedidos]

        return view('cliente.historico_pedidos', compact('pedidos'));
    }
    public function getPedidoCliente($id)
    {
        // "SELECT E.NM_Entregador, Pe.DS_Titulo, Pr.VL_Proposta, ""
        // FROM Entregador E
        // JOIN Proposta Pr ON ( Pr.CD_Entregador = E.CD_Entregador )
        // JOIN Pedido Pe ON ( Pr.CD_Pedido = Pe.CD_Pedido )
        // WHERE Pe.CD_Requisitante = $_SESSION['LoggedUser'] &&
        //       Pe.CD_Pedido = $_SESSION['CD_Pedido'];"

        $pedido = Pedido::find($id);
        $propostas = Proposta::where('pedido_id', $pedido->id)->get();
        // $aceitos = Proposta::where('pedido_id', $id)->get();
        // $entregadores = [];
        // foreach($aceitos as $aceito) {
        //     $entregadores[] = Entregador::find($aceito->entregador_id);
        // }
        

        return view('cliente/pedido_page', compact(['pedido', 'propostas']));
    }
    public function getPedidoEntregador($id)
    {
        //$pedido = Pedido::find($id);
        
        return view('entregador/pedido_page');
    }
}
