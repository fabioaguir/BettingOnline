<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\campeonatosRepository;
use Softage\Entities\Campeonatos;

/**
 * Class CampeonatosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CampeonatosRepositoryEloquent extends BaseRepository implements CampeonatosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Campeonatos::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
