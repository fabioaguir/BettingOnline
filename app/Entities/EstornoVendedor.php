<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class EstornoVendedor extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'estorno_vendedor';

    protected $fillable = [
        'nome'
    ];

}
