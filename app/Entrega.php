<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    //
    protected $table = 'entrega_aceita';

    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }
    public function pedido()
    {   
        return $this->belongsTo('App\Pedido');
    }
}
