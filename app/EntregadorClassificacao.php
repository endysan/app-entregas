<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregadorClassificacao extends Model
{
    //
    protected $table = 'entregador_classificacao';

    public function entregador()
    {
        return $this->belongsTo('App\Entregador');
    }
}
