<?php

namespace Seracademico\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GrauInstrucao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "grau_instrucoes";

    protected $fillable = [
        'nome'
    ];

}
