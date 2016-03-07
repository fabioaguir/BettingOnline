<?php

namespace Seracademico\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Seracademico\Repositories\InstituicaoSuperiorRepository;
use Seracademico\Entities\InstituicaoSuperior;
use Seracademico\Validators\InstituicaoSuperiorValidator;;

/**
 * Class InstituicaoSuperiorRepositoryEloquent
 * @package namespace App\Repositories;
 */
class InstituicaoSuperiorRepositoryEloquent extends BaseRepository implements InstituicaoSuperiorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstituicaoSuperior::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstituicaoSuperiorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
