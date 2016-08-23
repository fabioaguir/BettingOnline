<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Times extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'times';
    
    protected $fillable = [
        'nome',
        'status_id'
    ];

}
