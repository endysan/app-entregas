<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificacao')->nullable();
            $table->integer('id_usuario')->unsigned();
            $table->string('estado');
            $table->string('cidade');
            $table->string('bairro');
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
        Schema::dropIfExists('enderecos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
