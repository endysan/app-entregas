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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->string('produto');
            $table->text('descricao');
            $table->string('estado');
            $table->string('cidade');
            $table->string('bairro');
            $table->date('dt_entrega');
            $table->enum('status', ['iniciado', 'confirmaçao', 'aceito', 'finalizado', 'cancelado'])->default('iniciado');
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
        Schema::dropIfExists('pedidos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
