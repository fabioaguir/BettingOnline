<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CategoryPay extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'category_pay';

    protected $fillable = [ 
		'catp_id',
		'catp_name',
	];

} 