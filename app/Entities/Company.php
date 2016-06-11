<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Company extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'company';

    protected $fillable = [ 
		'com_id',
		'com_name',
		'com_email',
		'com_site',
		'com_phone',
		'com_phone2',
		'com_adr_id',
	];

}