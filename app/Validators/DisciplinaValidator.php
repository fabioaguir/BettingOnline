<?php

namespace Seracademico\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DisciplinaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'nome' =>  '' ,
			'carga_horaria' =>  '' ,
			'qtd_credito' =>  '' ,
			'qtd_falta' =>  '' ,
			'tipo_disciplina_id' =>  '' ,
			'tipo_avaliacao_id' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
