<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idEmpleado')->unsigned();
            $table->integer('idCliente')->unsigned();
            $table->string('numero_venta', 10)->unique();
            $table->string('numero_documento', 15);
            $table->date('fecha')->nullable();
            $table->decimal('utilidad', 7,2)->default('0.0');
            $table->integer('idUsuario')->unsigned();
            $table->decimal('comision', 4, 2)->default('0.0');
            $table->char('estadocancelado', 1)->default('N');
            $table->timestamps();

            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idEmpleado')->references('id')->on('empleado');
            $table->foreign('idCliente')->references('id')->on('cliente');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
