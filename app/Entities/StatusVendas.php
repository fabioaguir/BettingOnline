<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class StatusVendas extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'status_vendas';
    
    protected $fillable = [
        'nome'
    ];

}
