<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCargo')->unsigned();
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('photo', 50)->default('nouser.jpg');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('idCargo')->references('id')->on('cargo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
