<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AreasValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required'
        ],
   ];
}
