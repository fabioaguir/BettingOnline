<?php

namespace Seracademico\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class InstituicaoMedio extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "instituicao_medio";

    protected $fillable = [
        'nome'
    ];

}
