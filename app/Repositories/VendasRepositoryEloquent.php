<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\VendasRepository;
use Softage\Entities\Vendas;

/**
 * Class VendasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VendasRepositoryEloquent extends BaseRepository implements VendasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vendas::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
