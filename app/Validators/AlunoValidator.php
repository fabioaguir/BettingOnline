<?php

namespace Seracademico\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AlunoValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required',
            'turma'  => 'required',
            'matricula'  => 'required'

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}