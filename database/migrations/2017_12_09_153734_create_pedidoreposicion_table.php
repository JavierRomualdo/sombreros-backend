<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoreposicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidoreposicion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProveedorPrecio')->unsigned();
            $table->integer('cantidad')->default('0');
            $table->integer('cantidadingresado')->default('0');
            $table->integer('cantidadorden')->default('0');
            $table->char('estado', 1)->default('N');
            $table->date('fecha')->nullable();
            //$table->timestamps();

            $table->foreign('idProveedorPrecio')->references('id')->on('proveedor_precio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidoreposicion');
    }
}
