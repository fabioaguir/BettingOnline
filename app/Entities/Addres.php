<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Addres extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'address';

    protected $fillable = [ 
		'id',
		'adr_cep',
		'adr_country',
		'adr_city',
		'adr_district',
		'adr_address',
		'adr_sta_id',
	];

	public function state()
	{
		return $this->belongsTo(State::class, 'adr_sta_id');
	}

}