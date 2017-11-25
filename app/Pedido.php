<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $table = 'pedido'; // verificar
    protected $dates = ['deleted_at'];
    public static $categoriaPedido = ['pendente' => 'pendente', 'aceito' => 'aceito'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    
    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }
    public static function categoriaPedido($value)
    {
        return self::$cagetoriaPedido[$value];
    }
}
