<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = 'pedido'; // verificar

    protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function categoria()
    {
        return $this->belongsToMany('App\CategoriaPedido')->using('App\PedidoHasCategoria');
    }
}
