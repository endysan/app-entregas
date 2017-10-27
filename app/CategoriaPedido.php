<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaPedido extends Model
{
    //
    protected $table = 'categoria_pedido';
    
    public function pedido()
    {
        return $this->belongsToMany('App\Pedido')->using('App\PedidoHasCategoria');
    }
}
