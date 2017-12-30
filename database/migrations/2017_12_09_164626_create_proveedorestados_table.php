<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorestadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_estados', function (Blueprint $table) {
            $table->increments('id');
            $table->char('estado_titular', 1)->default('N');
            $table->char('estado_dni_titular', 1)->default('N');
            $table->char('estado_telefono_titular', 1)->default('N');
            $table->char('estado_email_titular', 1)->default('N');
            $table->char('estado_segundo_contacto', 1)->default('N');
            $table->char('estado_dni_segundo', 1)->default('N');
            $table->char('estado_telefono_segundo', 1)->default('N');
            $table->char('estado_email_segundo', 1)->default('N');
            $table->char('estado_empresa', 1)->default('N');
            $table->char('estado_ruc', 1)->default('N');
            $table->char('estado_direccion', 1)->default('N');
            $table->char('estado_numero_cuenta', 1)->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor_estados');
    }
}
