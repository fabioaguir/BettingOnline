<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Local extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'local';

    protected $fillable = [ 
		'loc_id',
		'loc_value',
		'loc_occupants',
		'loc_visible',
		'loc_title',
		'loc_lot_id',
		'loc_name',
	];

}