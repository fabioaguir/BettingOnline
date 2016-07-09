<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TipoCotacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'tipo_cotacao';

    protected $fillable = [
        'nome'
    ];

}
