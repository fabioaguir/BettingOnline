<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\TipoApostasRepository;
use Softage\Entities\TipoApostas;

/**
 * Class TipoApostasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TipoApostasRepositoryEloquent extends BaseRepository implements TipoApostasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoApostas::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
