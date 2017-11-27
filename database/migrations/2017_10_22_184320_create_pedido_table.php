<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('titulo');
            $table->string('descricao', 255)->nullable();
            $table->string('img_pedido', 255)->nullable();
            $table->date('data_coleta');
            $table->string('periodo_coleta'); 
            $table->string('cep_origem');
            $table->string('logradouro_origem');
            $table->string('complemento_origem')->nullable();
            $table->string('bairro_origem');
            $table->string('cidade_origem');
            $table->string('estado_origem');
            $table->string('cep_destino');
            $table->string('logradouro_destino');
            $table->string('complemento_destino')->nullable();
            $table->string('bairro_destino');
            $table->string('cidade_destino');
            $table->string('estado_destino');
            $table->string('status_pedido'); // TODO
            $table->integer('cliente_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('pedido');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
