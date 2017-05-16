<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    //
    protected $fillable = [
        'id_pedido', 'id_entregador', 'dt_entrega', 'status'
    ];
    protected $table = 'entregas';

}
