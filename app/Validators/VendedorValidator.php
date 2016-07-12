<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class VendedorValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'status_id' => 'required',
            'estorno_id' => 'required',
            'area_id' => 'required',
            'config[limite_vendas]' => 'required',
            'config[comissao]' => 'required',
            'config[cotacao]' => 'required',
            'config[tipo_cotacao_id]' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'status_id' => 'required',
            'estorno_id' => 'required',
            'area_id' => 'required',
            'config[limite_vendas]' => 'required',
            'config[comissao]' => 'required',
            'config[cotacao]' => 'required',
            'config[tipo_cotacao_id]' => 'required',
        ],
   ];

}
