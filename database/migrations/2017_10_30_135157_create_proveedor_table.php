<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('proveedor', 100);
            //$table->char('dni', 8);
            //$table->char('estado_titular', 1)->default('N');
            $table->string('titular', 50)->nullable();
            $table->char('dni_titular', 8)->nullable()->unique();
            $table->string('telefono_titular', 9)->nullable();
            $table->string('email_titular', 50)->nullable();
            $table->string('segundo_contacto', 50)->nullable();
            $table->char('dni_segundo', 8)->nullable()->unique();
            $table->string('telefono_segundo', 9)->nullable();
            $table->string('email_segundo', 50)->nullable();
            $table->string('empresa', 70)->nullable();
            $table->char('ruc', 11)->nullable()->unique();
            $table->string('direccion', 80)->nullable();
            $table->string('numero_cuenta', 21)->nullable();//3-17
            $table->date('fecha_ingreso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
}
