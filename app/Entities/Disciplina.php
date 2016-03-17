<?php

namespace Seracademico\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Disciplina extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'fac_disciplinas';

    protected $fillable = [ 
		'nome',
		'carga_horaria',
		'qtd_credito',
		'qtd_falta',
		'tipo_disciplina_id',
		'tipo_avaliacao_id',
	];

}