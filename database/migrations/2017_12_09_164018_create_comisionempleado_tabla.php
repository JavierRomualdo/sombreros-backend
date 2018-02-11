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
            $table->decimal('porcentaje', 5, 2)->default('0.0');
            $table->string('descripcion', 100)->nullable();
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
        //
    }
}
