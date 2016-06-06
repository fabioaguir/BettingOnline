<?php

namespace Softage\Entities;

use Faker\Provider\sr_Latn_RS\Address;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Guest extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'guest';

    protected $fillable = [ 
		'id',
		'gue_name',
		'gue_cpf',
		'gue_rg',
		'gue_email',
		'gue_phone',
		'gue_phone2',
		'gue_dt_birth',
		'gue_gen_id',
		'gue_adr_id',
		'gue_visible',
	];

	public function address()
	{
		return $this->belongsTo(Addres::class, 'gue_adr_id');
	}

	public function gender()
	{
		return $this->belongsTo(Gender::class, 'gue_gen_id');
	}

}