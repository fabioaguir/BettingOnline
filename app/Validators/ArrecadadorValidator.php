<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ArrecadadorValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'status_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'status_id' => 'required',
        ],
   ];
}
