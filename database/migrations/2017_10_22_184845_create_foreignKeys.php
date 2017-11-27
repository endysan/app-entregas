<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::table('entregador', function($table) {
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
        });
        
        Schema::table('pedido', function($table) {
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
        //
    }
}
