<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CotacoesValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'valor' => 'required',
            'partida_id' => 'required',
            'modalidade_id' => 'required',
            'status_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'valor' => 'required',
            'partida_id' => 'required',
            'modalidade_id' => 'required',
            'status_id' => 'required'
        ],
   ];
}
