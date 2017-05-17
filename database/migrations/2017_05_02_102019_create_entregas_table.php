<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('entregas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('id_pedido')->unsigned();
            $table->integer('id_entregador')->unsigned();
            $table->integer('id_has_entregadores')->unsigned();
            $table->enum('status', ['aguardando', 'aceito', 'cancelado'])->default('aguardando');
            $table->timestamps();
        });
        DB::update('ALTER TABLE users AUTO_INCREMENT = 1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('entregas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
