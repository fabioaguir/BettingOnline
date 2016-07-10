<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\PartidasRepository;
use Softage\Entities\Partidas;
use Softage\Validators\PartidasValidator;

/**
 * Class PartidaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PartidasRepositoryEloquent extends BaseRepository implements PartidasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Partidas::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PartidasValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
