<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Validators\AddresValidator;
use Softage\Repositories\AddresRepository;
use Softage\Entities\Addres;

/**
 * Class AddresRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AddresRepositoryEloquent extends BaseRepository implements AddresRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Addres::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return AddresValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
