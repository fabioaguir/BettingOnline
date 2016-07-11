<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\TipoCotacaoRepository;
use Softage\Entities\TipoCotacao;

/**
 * Class TipoCotacaoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TipoCotacaoRepositoryEloquent extends BaseRepository implements TipoCotacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoCotacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
