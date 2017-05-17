<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoHasEntregadoresTable extends Migration
{
    public function up()
    {
        Schema::create('pedido_has_entregadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pedido')->unsigned();            
            $table->integer('id_entregador')->unsigned();
            $table->string('email');
            $table->timestamps();
        });
         DB::update('ALTER TABLE users AUTO_INCREMENT = 1;');
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('pedido_has_entregadores');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
