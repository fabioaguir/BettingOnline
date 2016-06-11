<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Validators\GenderValidator;
use Softage\Repositories\GenderRepository;
use Softage\Entities\Gender;

/**
 * Class GenderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GenderRepositoryEloquent extends BaseRepository implements GenderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Gender::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return GenderValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
