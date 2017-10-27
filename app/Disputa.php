<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disputa extends Model
{
    protected $table = 'disputa';

    public function pedido()
    {
        // verificar
        return $this->hasOne('App\Pedido');
    }

    public function entregador()
    {
        // Verificar
        return $this->hasOne('App\Entregador');
    }

    public function cliente()
    {
        // verificar
        return $this->hasOne('App\Cliente');
    }
}
