<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiaingresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_ingreso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_guia', 10)->unique();
            $table->date('fecha')->nullable();
            $table->integer('idProveedor')->unsigned();

            $table->foreign('idProveedor')->references('id')->on('proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guia_ingreso');
    }
}