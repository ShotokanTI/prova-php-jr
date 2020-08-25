<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $usuario) {
            $usuario->increments('id')->unique();
            $usuario->string('nome');
            $usuario->bigInteger('cpf')->unique()->unsigned();
            $usuario->date('data_nascimento');
            $usuario->bigInteger('telefone')->unsigned();
            $usuario->string('endereco',40);
            $usuario->string('estado',2);
            $usuario->string('cidade',40);
            $usuario->timestamps();
        });

    }
    
        
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
