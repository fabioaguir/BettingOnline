<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\ArrecadadorRepository;
use Softage\Entities\Arrecadador;
use Softage\Validators\ArrecadadorValidator;

/**
 * Class PessoasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArrecadadorRepositoryEloquent extends BaseRepository implements ArrecadadorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Arrecadador::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ArrecadadorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
