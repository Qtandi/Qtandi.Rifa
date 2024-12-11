<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    // Participant
    // Cada número sorteado é associado ao CPF da pessoa
    protected $fillable = [
        'id',
        'name',
        'cpf',
        'numbers'
    ];

    protected $hidden = [
        'cpf'
    ];
}
