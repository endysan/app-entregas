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
        Schema::dropIfExists('entregas');
        
        Schema::create('entregas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('id_pedido')->unsigned()->nullable();
            $table->integer('id_entregador')->unsigned()->nullable();
            $table->date('dt_entrega');
            $table->enum('status', ['Iniciado', 'Aceito', 'Finalizado'])->default('Iniciado');
            $table->timestamps();
        });
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
