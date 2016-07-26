<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\arrecadacoesRepository;
use Softage\Entities\Arrecadacoes;

/**
 * Class ArrecadacoesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArrecadacoesRepositoryEloquent extends BaseRepository implements ArrecadacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Arrecadacoes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
