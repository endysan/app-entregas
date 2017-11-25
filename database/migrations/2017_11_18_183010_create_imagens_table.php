<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagem', function (Blueprint $table) {
            $table->increments('id');
            $table->string('local_imagem', 255);
            $table->string('nome_imagem')->nullable();
            $table->integer('pedido_id')->unsigned()->nullable();
            $table->integer('veiculo_id')->unsigned()->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedido')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('veiculo_id')->references('id')->on('veiculo')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('imagens');
    }
}
