<?php

namespace Seracademico\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Seracademico\Repositories\InstituicaoMedioRepository;
use Seracademico\Entities\InstituicaoMedio;
use Seracademico\Validators\InstituicaoMedioValidator;;

/**
 * Class InstituicaoMedioRepositoryEloquent
 * @package namespace App\Repositories;
 */
class InstituicaoMedioRepositoryEloquent extends BaseRepository implements InstituicaoMedioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstituicaoMedio::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstituicaoMedioValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
