<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdencompradetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compra_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idOrdenCompra')->unsigned();
            $table->integer('idSombrero')->unsigned();
            $table->integer('cantidad')->default('0');
            $table->integer('cantidad_ingreso')->default('0');
            $table->string('estado_ingreso')->default('No Ingresado');//Estados: "Ingresado", "Falta Ingresar", "No Ingresado
            $table->decimal('precio_unitario', 7, 2)->default('0.0');
            $table->string('descripcion', 100)->nullable()->default('');//->nullable()

            $table->foreign('idOrdenCompra')->references('id')->on('orden_compra');
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
        Schema::dropIfExists('orden_compra_detalle');
    }
}
