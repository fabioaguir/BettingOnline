<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\TabletsRepository;
use Softage\Entities\Tablets;

/**
 * Class ApostasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TabletsRepositoryEloquent extends BaseRepository implements TabletsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tablets::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
