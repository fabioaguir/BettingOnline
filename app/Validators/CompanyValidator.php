<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CompanyValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'id' =>  '' ,
			'name' =>  '' ,
			'com_email' =>  '' ,
			'com_site' =>  '' ,
			'com_phone' =>  '' ,
			'com_phone2' =>  '' ,
			'com_adr_id' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
