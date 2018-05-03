<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idSombrero')->unsigned();            
            $table->integer('cantidadingreso')->nullable();
            $table->decimal('costounitario', 7,2)->nullable();
            $table->decimal('costototal', 7,2)->nullable();
            $table->integer('cantidadsalida')->nullable();
            $table->decimal('preciounitario', 7,2)->nullable();
            $table->decimal('preciototal', 7,2)->nullable();
            $table->integer('stock_actual');
            $table->decimal('valor', 7,2)->default('0.0');
            $table->decimal('costopromedio', 7,2)->default('0.0');
            $table->decimal('margenganancia', 7,2)->default('0.0');
            $table->decimal('preciosistema', 7,2)->default('0.0');
            $table->date('fecha')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('movimiento');
    }
}
