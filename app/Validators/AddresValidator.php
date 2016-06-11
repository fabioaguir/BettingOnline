<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AddresValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'id' =>  '' ,
			'adr_cep' =>  '' ,
			'adr_country' =>  '' ,
			'adr_city' =>  '' ,
			'adr_district' =>  '' ,
			'adr_address' =>  '' ,
			'adr_sta_id' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
