<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\estorno_vendedorRepository;
use Softage\Entities\EstornoVendedor;

/**
 * Class EstornoVendedorRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EstornoVendedorRepositoryEloquent extends BaseRepository implements EstornoVendedorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstornoVendedor::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
