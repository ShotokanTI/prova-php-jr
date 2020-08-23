<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $Roles) {
            $Roles->increments('codigo_role')->unique();
            $Roles->string('role',30);
            $Roles->unsignedBigInteger('cpf');
            $Roles->foreign('cpf')->references('cpf')->on('usuario');
            $Roles->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
