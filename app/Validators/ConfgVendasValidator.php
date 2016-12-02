<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ConfgVendasValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'limite_vendas' => 'required',
            'comissao' => 'required',
            'cotacao' => 'required',
            'tipo_cotacao_id' => 'required',
            'vendedor_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'limite_vendas' => 'required',
            'comissao' => 'required',
            'cotacao' => 'required',
            'tipo_cotacao_id' => 'required',
            'vendedor_id' => 'required',
        ],
   ];
}
