<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Service extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'service';

    protected $fillable = [ 
		'sev_id',
		'sev_name',
		'sev_amount',
	];

}