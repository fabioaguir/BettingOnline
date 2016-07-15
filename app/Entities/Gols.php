<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Gols extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table    = 'gols';

    /**
     * @var array
     */
    protected $fillable = [
        'minutos',
        'partida_id',
        'time_id',
        'tempo_id'
    ];

}
