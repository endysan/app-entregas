<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregadores', function (Blueprint $table) {
            $table->increments('id_entregador');
            $table->integer('id_user');
            $table->string('cnh')->nullable(); //link para foto
            $table->enum('status', ['aprovado', 'andamento', 'reprovado'])->default('reprovado');
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
        Schema::dropIfExists('entregadores');
    }
}
