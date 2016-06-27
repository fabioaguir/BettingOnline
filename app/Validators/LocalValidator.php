<?php

namespace Softage\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class LocalValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            
			'id' =>  '' ,
			'loc_value' =>  'required' ,
			'loc_occupants' =>  '' ,
			'loc_visible' =>  '' ,
			'loc_title' =>  'required' ,
			'loc_lot_id' =>  '' ,
			'name' =>  'required' ,

        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

}
