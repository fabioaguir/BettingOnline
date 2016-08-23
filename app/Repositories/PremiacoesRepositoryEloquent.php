<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\premiacoesRepository;
use Softage\Entities\Premiacoes;

/**
 * Class PremiacoesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PremiacoesRepositoryEloquent extends BaseRepository implements PremiacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Premiacoes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
