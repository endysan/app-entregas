<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_pedido', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nome');
            $table->timestamps();
        });

        DB::table('categoria_pedido')->insert(array(
            // Inserir as categorias
            ['nome' => 'Cabe em um envelope'],
            ['nome' => 'Leve até 5kg'],
            ['nome' => 'Moderado até 20kg'],
            ['nome' => 'Pesado 50kg~100kg'],
            ['nome' => 'Muito 200kg'],
            ['nome' => 'Mudanças (Carreto)'],
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('categoria_pedido');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
