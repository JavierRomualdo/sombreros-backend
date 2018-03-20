<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idSombrero')->unsigned();
            $table->integer('stock')->default('0');
            $table->decimal('costo', 7, 2)->default('0.0');
            $table->decimal('precio', 7, 2)->default('0.0');
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
        Schema::dropIfExists('precios');
    }
}
