<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Validators\LocalTypeValidator;
use Softage\Repositories\LocalTypeRepository;
use Softage\Entities\LocalType;

/**
 * Class LocalTypeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LocalTypeRepositoryEloquent extends BaseRepository implements LocalTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LocalType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return LocalTypeValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
