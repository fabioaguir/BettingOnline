<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ServiceValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'sev_id' =>  '' ,
			'sev_name' =>  '' ,
			'sev_amount' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
