<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CategoryPayValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'catp_id' =>  '' ,
			'catp_name' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
