<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa');
            $table->string('renavam');
            $table->string('tipo_veiculo'); // Usa o enum que está em config/enum.php
            $table->integer('entregador_id')->unsigned();
            $table->timestamps();

            $table->foreign('entregador_id')->references('id')->on('entregador')->onDelete('cascade');
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
        Schema::dropIfExists('veiculos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
