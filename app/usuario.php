<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone',
        'endereco',
        'estado',
        'cidade'
    ];
}
