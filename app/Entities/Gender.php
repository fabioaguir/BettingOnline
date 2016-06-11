<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Gender extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'gender';

    protected $fillable = [ 
		'id',
		'name',
	];

}