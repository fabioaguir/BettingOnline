<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Parametros extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'nome_banca',
        'status',
        'mensagen_rodape',
        'limite_premiacao'
    ];

}
