<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrega;
use App\Pedido;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ver2/index');
    }
    public function dashboard()
    {
        $this->loginCheck();
        return view('ver2/dashboard');
    }

    public function historico()
    {
        $this->loginCheck();

        $pedidos = Pedido::where('id_usuario', auth()->id())->get();
        //dd($pedidos->first());
        $entregas = Entrega::all();

        foreach($pedidos as $pedido){
            $entrega = $entregas->where('id_pedido', $pedido->id);
        }

        $entrega = Entrega::where('id_pedido')->first();

        $data = [
            'title' => 'Home',
            'content' => 'AppEntrega',
            'pedidos' => $pedidos,
            'entrega' => $entrega
        ];
        //dd($data);
        return view('ver2/historico_pedidos', $data);
    }
    public function loginCheck()
    {
        if(!auth()->check()){
            return redirect('login');
        }
    }
}
