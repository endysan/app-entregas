<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $table = 'pedido'; // verificar
    protected $dates = ['deleted_at'];
    public static $statusPedido = ['pendente' => 'pendente', 'aceito' => 'aceito'];
    public static $periodoEntrega = [
        'dia' => 'Dia todo entre 8:00 e 18:00',
        'manha' => 'Manhã entre 8:00 e 12:00',
        'tarde' => 'Tarde entre 13:00 e 18:00'
    ];
    public static $categoriaVeiculo = [
        'moto' => 'Moto',
        'carro' => 'Carro',
        'caminhao' => 'Caminhão'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    
    public function proposta()
    {
        return $this->belongsTo('App\Proposta');
    }

    public function entrega()
    {
        return $this->hasOne('App\Entrega');
    }
    
    public static function statusPedido($value)
    {
        return self::$statusPedido[$value];
    }
    public static function periodoEntrega($value)
    {
        return self::$periodoEntrega[$value];
    }

    public static function categoriaVeiculo($value)
    {
        return self::$cagetoriaVeiculo[$value];
    }

}
