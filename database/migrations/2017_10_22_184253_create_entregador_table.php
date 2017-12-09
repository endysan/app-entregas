<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregador', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('cpf')->nullable();
            $table->string('cnh')->nullable();
            $table->double('classificacao')->nullable();
            $table->integer('cliente_id')->unsigned();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
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
        Schema::dropIfExists('entregador');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
