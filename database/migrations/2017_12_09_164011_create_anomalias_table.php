<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnomaliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anomalias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idGuiaIngreso')->unsigned();
            $table->integer('idFactura')->unsigned();
            $table->string('resultado', 200);

            $table->foreign('idGuiaIngreso')->references('id')->on('guia_ingreso');
            $table->foreign('idFactura')->references('id')->on('factura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anomalias');
    }
}
