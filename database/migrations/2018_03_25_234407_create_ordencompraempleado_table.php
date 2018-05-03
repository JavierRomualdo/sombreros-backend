<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdencompraempleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordencompraempleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idOrdenCompra')->unsigned();
            $table->integer('idEmpleado')->unsigned();
            $table->timestamps();

            $table->foreign('idOrdenCompra')->references('id')->on('orden_compra');
            $table->foreign('idEmpleado')->references('id')->on('empleado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordencompraempleado');
    }
}
