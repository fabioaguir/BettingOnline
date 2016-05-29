<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class GuestValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'gue_id' =>  '' ,
			'gue_name' =>  '' ,
			'gue_cpf' =>  '' ,
			'gue_rg' =>  '' ,
			'gue_email' =>  '' ,
			'gue_phone' =>  '' ,
			'gue_phone2' =>  '' ,
			'gue_dt_birth' =>  '' ,
			'gue_gen_id' =>  '' ,
			'gue_adr_id' =>  '' ,
			'gue_visible' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
