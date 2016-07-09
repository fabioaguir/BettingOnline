<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Vendedor extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'vendedor';

    protected $fillable = [
        'nome',
        'usuario',
        'senha',
        'status_id',
        'estorno_id',
        'areas_id'
    ];

}
