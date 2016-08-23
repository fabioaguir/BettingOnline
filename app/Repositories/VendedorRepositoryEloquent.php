<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\vendedorRepository;
use Softage\Entities\Vendedor;
use Softage\Validators\VendedorValidator;

/**
 * Class VendedorRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VendedorRepositoryEloquent extends BaseRepository implements VendedorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vendedor::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
