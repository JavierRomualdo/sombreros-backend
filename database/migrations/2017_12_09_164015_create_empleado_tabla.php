<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idEncargo')->unsigned();
            $table->string('nombres', 50)->unique();
            $table->string('apellidos', 100);
            $table->char('dni', 8)->nullable()->unique();
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 9)->nullable();
            $table->string('email', 50)->nullable();
            $table->timestamps();

            $table->foreign('idEncargo')->references('id')->on('encargo');
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
        Schema::dropIfExists('empleado');
    }
}
