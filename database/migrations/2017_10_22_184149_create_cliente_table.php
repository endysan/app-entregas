<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('img_perfil', 255)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('cliente');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
