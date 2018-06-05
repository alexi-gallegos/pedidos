<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor_total');

            $table->integer('trabajador_id')->unsigned();
            $table->foreign('trabajador_id')->references('id')->on('trabajadores')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('estado_pedido_id')->unsigned();
            $table->foreign('estado_pedido_id')->references('id')->on('estado_pedidos')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('mesa_id')->unsigned();
            $table->foreign('mesa_id')->references('id')->on('mesas')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('pedidos');
    }
}
