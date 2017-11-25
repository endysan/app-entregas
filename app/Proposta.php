<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    //
    protected $table = 'proposta';
    
    public function pedido()
    {
        return $this->hasMany('App\Pedido');
    }
    public function entregador()
    {
        return $this->hasMany('App\Pedido');
    }
}
