<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pedidos');
        
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->string('produto');
            $table->text('descricao');
            $table->string('estado');
            $table->string('cidade');
            $table->string('bairro');
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
        Schema::dropIfExists('pedidos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
