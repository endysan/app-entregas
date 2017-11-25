<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disputa', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('pedido_id')->unsigned();
            
            //$table->integer('disputa_has_entregador_id')->unsigned();
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
        Schema::dropIfExists('disputa');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
