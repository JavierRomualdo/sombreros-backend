<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorprecioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_precio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProveedor')->unsigned();
            $table->integer('idSombrero')->unsigned();
            $table->decimal('precio', 7, 2)->default('0.0');

            $table->foreign('idProveedor')->references('id')->on('proveedor');
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
        Schema::dropIfExists('proveedor_precio');
    }
}
