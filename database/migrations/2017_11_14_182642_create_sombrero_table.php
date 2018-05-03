<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSombreroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sombrero', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idModelo')->unsigned();
            $table->integer('idTejido')->unsigned();
            $table->integer('idPublicoDirigido')->unsigned();
            $table->integer('idMaterial')->unsigned();
            $table->integer('idTalla')->unsigned();           
            //$table->integer('idAtributo')->unsigned();
            $table->string('codigo', 14)->unique();
            $table->decimal('precio_venta', 7, 2)->default('0.0');
            $table->decimal('precio_lista', 7, 2)->default('0.0'); 
            $table->decimal('costo_promedio', 7, 2)->default('0.0');                       
            $table->decimal('utilidad',7,2)->default('0.0');
            $table->integer('stock_actual')->default('0');
            $table->integer('pedido_reposicion')->default('0');
            $table->decimal('costorepminimo', 7, 2)->default('0.0');
            $table->decimal('costorepmaximo', 7, 2)->default('0.0');
            $table->integer('stock_minimo')->default('0');
            $table->integer('stock_maximo')->default('0');
            $table->string('photo', 50)->default('nofoto.png');//para imagenes, ->nullable() para valor nulo

            $table->foreign('idModelo')->references('id')->on('modelos');
            $table->foreign('idTejido')->references('id')->on('tejidos');
            $table->foreign('idPublicoDirigido')->references('id')->on('publicodirigido');
            $table->foreign('idMaterial')->references('id')->on('materiales');
            $table->foreign('idTalla')->references('id')->on('tallas');
            //$table->foreign('idAtributo')->references('id')->on('atributos');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sombrero');
    }
}
