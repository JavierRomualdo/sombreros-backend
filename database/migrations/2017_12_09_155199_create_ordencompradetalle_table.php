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
            $table->integer('idProveedorPrecio')->unsigned();
            $table->integer('idPedidoReposicion')->nullable()->unsigned();
            $table->integer('cantidad')->default('0');
            $table->integer('cantidadingreso')->default('0');
            $table->string('estadoingreso')->default('No Ingresado');//Estados: "Ingresado", "Falta Ingresar", "No Ingresado
            $table->decimal('costounitario', 7, 2)->default('0.0');
            $table->string('descripcion', 100)->nullable()->default('');
            
            $table->foreign('idOrdenCompra')->references('id')->on('orden_compra');
            $table->foreign('idProveedorPrecio')->references('id')->on('proveedor_precio');
            $table->foreign('idPedidoReposicion')->references('id')->on('pedidoreposicion');
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
