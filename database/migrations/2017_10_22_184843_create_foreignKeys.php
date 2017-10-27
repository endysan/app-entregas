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
        Schema::table('cliente', function($table){
            $table->foreign('entregador_id')->references('id')->on('entregador')->onDelete('cascade');
        });
        
        Schema::table('entregador', function($table) {
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
        });
        
        Schema::table('pedido', function($table) {
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
        });
        Schema::table('pedido_has_categoria', function(){
            $table->foreign('pedido_id')->references('id')->on('pedido')->onDelete('cascade');
            $table->integer('categoria_pedido_id')->references('id')->on('categoria_pedido')->onDelete('cascade');
        });

        Schema::table('disputa' ,function($table){
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedido')->onDelete('cascade');
        });
        Schema::table('disputa_has_entregador' ,function($table){
            $table->foreign('pedido_id')->references('id')->on('pedido')->onDelete('cascade');
            $table->foreign('entregador_id')->references('id')->on('entregador')->onDelete('cascade');
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
