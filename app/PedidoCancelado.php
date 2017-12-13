<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoCancelado extends Model
{
    //
    protected $table = 'pedido_cancelado';

    public function pedido()
    {
        return $this->belongsTo('App\Pedido');
    }
}
