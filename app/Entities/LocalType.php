<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LocalType extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'local_type';

    protected $fillable = [ 
		'lot_id',
		'lot_name',
	];

}