<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('igv', 4, 2)->default('0.00');
            $table->decimal('margenganancia', 4, 2)->default('0.00');
            $table->decimal('preciominimo', 4, 2)->default('0.00');
            $table->decimal('preciomaximo', 4, 2)->default('0.00');
            $table->decimal('costorepmaximo', 7, 2)->default('0.00');
            $table->decimal('costoserviciorep', 4, 2)->default('0.00');
            $table->decimal('descuentoventa', 4, 2)->default('0.00');
            $table->decimal('descuentoextra', 4, 2)->default('0.00');
            //$table->char('estadodescextra', 1)->default('N');
            $table->decimal('comision', 4, 2)->default('0.00');
            //
            $table->decimal('rangopr1', 4, 2)->default('0.00');
            $table->string('mensajepr1', 50)->nullable();
            $table->string('colorpr1', 6)->default('ffffff');
            $table->decimal('rangopr2', 4, 2)->default('0.00');
            $table->string('mensajepr2', 50)->nullable();
            $table->string('colorpr2', 6)->default('ffffff');
            $table->decimal('rangopr3', 4, 2)->default('0.00');
            $table->string('mensajepr3', 50)->nullable();
            $table->string('colorpr3', 6)->default('ffffff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atributos');
    }
}
