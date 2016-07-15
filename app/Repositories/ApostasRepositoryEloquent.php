<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\ApostasRepository;
use Softage\Entities\Apostas;

/**
 * Class ApostasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ApostasRepositoryEloquent extends BaseRepository implements ApostasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Apostas::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
