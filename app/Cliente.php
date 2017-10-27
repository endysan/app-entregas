<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    use Notifiable;

    protected $table = 'cliente';
    
    protected $fillable = [
        'nome', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function entregador()
    {
        return $this->hasOne('App\Entregador');
    }
    public function pedido()
    {
        return $this->hasMany('App\Pedido');
    }
    public function getPrimeiroNomeAttribute()
    {
        return ucfirst(explode(' ', $this->nome)[0]);
    }
    
    public function getIsEntregadorAttribute()
    {
        // 
        return $this->entregador_id != null;
    }
}
