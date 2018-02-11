<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiaingresodetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_ingreso_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idGuiaIngreso')->unsigned();
            //$table->integer('idSombrero')->unsigned();
            $table->integer('idOrdenCompraDetalle')->unsigned();
            $table->integer('cantidad')->default('0');
            $table->string('descripcion', 100)->nullable()->default('');

            $table->foreign('idGuiaIngreso')->references('id')->on('guia_ingreso');
            //$table->foreign('idSombrero')->references('id')->on('sombrero');
            $table->foreign('idOrdenCompraDetalle')->references('id')->on('orden_compra_detalle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guia_ingreso_detalle');
    }
}
