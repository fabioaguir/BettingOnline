<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\ConfVendasRepository;
use Softage\Entities\ConfVendas;

/**
 * Class ConfVendasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ConfVendasRepositoryEloquent extends BaseRepository implements ConfVendasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ConfVendas::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
