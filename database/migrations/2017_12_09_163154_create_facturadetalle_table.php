<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturadetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idFactura')->unsigned();
            $table->integer('idSombrero')->unsigned();
            $table->string('descripcion', 100);
            $table->decimal('precio_unitario', 7, 2)->default('0.0');
            $table->integer('cantidad')->default('0');
            $table->decimal('sub_total', 7, 2)->default('0.0');

            $table->foreign('idFactura')->references('id')->on('factura');
            $table->foreign('idSombrero')->references('id')->on('sombrero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_detalle');
    }
}
