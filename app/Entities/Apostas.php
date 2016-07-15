<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Apostas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table    = 'apostas';

    /**
     * @var array
     */
    protected $fillable = [
        'venda_id',
        'partida_id',
        'caotacao_id',
        'valor'
    ];
}
