<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelaciondetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelaciondetalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCancelacion')->unsigned();
            $table->integer('idVenta')->unsigned();
            $table->timestamps();

            $table->foreign('idCancelacion')->references('id')->on('cancelacion');
            $table->foreign('idVenta')->references('id')->on('venta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancelaciondetalle');
    }
}
