<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Validators\GuestValidator;
use Softage\Repositories\GuestRepository;
use Softage\Entities\Guest;

/**
 * Class GuestRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GuestRepositoryEloquent extends BaseRepository implements GuestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Guest::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return GuestValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
