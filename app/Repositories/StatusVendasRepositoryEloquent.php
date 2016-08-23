<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\StatusVendasRepository;
use Softage\Entities\StatusVendas;

/**
 * Class StatusVendasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class StatusVendasRepositoryEloquent extends BaseRepository implements StatusVendasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StatusVendas::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
