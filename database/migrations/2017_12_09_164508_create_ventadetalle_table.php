<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentadetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idVenta')->unsigned();
            $table->integer('idSombrero')->unsigned();
            $table->integer('cantidad')->default('0');
            $table->decimal('precio_venta', 7, 2)->default('0.0');
            $table->decimal('porcentaje_descuento', 5, 2)->default('0.0');
            $table->decimal('descuento', 7, 2)->default('0.0');
            $table->decimal('sub_total', 7, 2)->default('0.0');
            $table->decimal('utilidad', 7,2)->default('0.0');
            $table->decimal('comisionempleado', 5, 2)->default('0.0');
            $table->string('descripcion', 100)->nullable()->default('');
            $table->timestamps();

            $table->foreign('idVenta')->references('id')->on('venta');
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
        Schema::dropIfExists('venta_detalle');
    }
}
