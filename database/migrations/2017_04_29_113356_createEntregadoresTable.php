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
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('id_usuario')->unsigned()->unique();
            $table->string('veiculo');
            $table->string('cnh');
            $table->enum('status', ['reprovado', 'andamento', 'aprovado'])->default('andamento');
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
        Schema::dropIfExists('entregadores');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
