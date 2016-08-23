<?php

namespace  Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\ModalidadesRepository;
use Softage\Entities\Modalidades;
use Softage\Validators\ModalidadesValidator;

/**
 * Class ModalidadesRepositoryEloquent
 * @package namespace  Softage\Repositories;
 */
class ModalidadesRepositoryEloquent extends BaseRepository implements ModalidadesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Modalidades::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ModalidadesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
