<?php

namespace Seracademico\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Sala extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "fac_salas";

    protected $fillable = [
        'nome',
        'bloco',
        'andar',
        'numero',
        'capacidade',
        'situacao'
    ];

}
