<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Validators\CategoryPayValidator;
use Softage\Repositories\CategoryPayRepository;
use Softage\Entities\CategoryPay;

/**
 * Class CategoryPayRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CategoryPayRepositoryEloquent extends BaseRepository implements CategoryPayRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryPay::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return CategoryPayValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
