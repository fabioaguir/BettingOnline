<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Validators\LocalValidator;
use Softage\Repositories\LocalRepository;
use Softage\Entities\Local;

/**
 * Class LocalRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LocalRepositoryEloquent extends BaseRepository implements LocalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Local::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return LocalValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
