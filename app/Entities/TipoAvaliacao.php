<?php

namespace Seracademico\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TipoAvaliacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'fac_tipo_avaliacoes';

    protected $fillable = [ 
		'nome',
	];

}