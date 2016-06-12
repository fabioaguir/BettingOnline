<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class LocalValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'id' =>  '' ,
			'loc_value' =>  '' ,
			'loc_occupants' =>  '' ,
			'loc_visible' =>  '' ,
			'loc_title' =>  '' ,
			'loc_lot_id' =>  '' ,
			'name' =>  '' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
