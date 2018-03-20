<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComisionempleadoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('comisionempleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idEmpleado')->unsigned();
            $table->integer('idSombrero')->unsigned();
            $table->integer('idTemporada')->unsigned();
            $table->decimal('porcentaje', 5, 2)->default('0.0');
            //$table->string('descripcion', 100)->nullable();
            $table->timestamps();

            $table->foreign('idEmpleado')->references('id')->on('empleado');
            $table->foreign('idSombrero')->references('id')->on('sombrero');
            $table->foreign('idTemporada')->references('id')->on('temporada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
