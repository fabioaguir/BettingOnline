<?php

namespace Seracademico\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CursoValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'nome' =>  '' ,
			'codigo' =>  '' ,
			'duracao_meses' =>  '' ,
			'portaria_mec_rec' =>  '' ,
			'numero_decreto_rec' =>  '' ,
			'data_decreto_rec' =>  '' ,
			'data_dou_rec' =>  '' ,
			'portaria_mec_aut' =>  '' ,
			'numero_decreto_aut' =>  '' ,
			'data_decreto_aut' =>  '' ,
			'data_dou_aut' =>  '' ,
			'data_matricula_inicio' =>  '' ,
			'data_matricula_fim' =>  '' ,
			'inicio_aula' =>  '' ,
			'fim_aula' =>  '' ,
			'maximo_vagas' =>  '' ,
			'minumo_vagas' =>  '' ,
			'obs_vagas' =>  '' ,
			'valor' =>  '' ,
			'parcelas' =>  '' ,
			'vencimento_inicial' =>  '' ,
			'sede_id' =>  '' ,
			'tipo_curso_id' =>  '' ,
			'cordenador_id' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
