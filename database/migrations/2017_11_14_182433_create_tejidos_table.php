<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTejidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tejidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tejido', 50);
            $table->string('photo', 50)->default('nofoto.png');
            $table->string('descripcion', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tejidos');
    }
}
