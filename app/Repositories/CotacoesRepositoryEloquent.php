<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\CotacoesRepository;
use Softage\Entities\Cotacoes;
use Softage\Validators\CotacoesValidator;

/**
 * Class CotacoesRepositoryEloquent
 * @package namespace Softage\Repositories;
 */
class CotacoesRepositoryEloquent extends BaseRepository implements CotacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cotacoes::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CotacoesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
