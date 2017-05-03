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
        Schema::dropIfExists('entregadores');
        
        Schema::create('entregadores', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->string('cnh');
            $table->string('veiculo');
            $table->enum('status', ['Reprovado', 'Andamento', 'Aprovado'])->default('Reprovado');
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
        Schema::dropIfExists('entregadores');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
