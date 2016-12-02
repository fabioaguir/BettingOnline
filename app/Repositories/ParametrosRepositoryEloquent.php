<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\parametrosRepository;
use Softage\Entities\Parametros;
use Softage\Validators\ParametrosValidator;

/**
 * Class ParametrosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ParametrosRepositoryEloquent extends BaseRepository implements ParametrosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Parametros::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ParametrosValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
