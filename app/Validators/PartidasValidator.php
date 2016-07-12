<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PartidasValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    /**
     * @var array
     *
     * Array que armazenará a validação
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'data' => 'required',
            'hora' => 'required',
            'campeonato_id' => 'required',
            'time_casa_id' => 'required',
            'time_fora_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'data' => 'required',
            'hora' => 'required',
            'campeonato_id' => 'required',
            'time_casa_id' => 'required',
            'time_fora_id' => 'required',
        ],
   ];
}
