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
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
