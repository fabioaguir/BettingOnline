<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\ImpressorasRepository;
use Softage\Entities\Impressoras;

/**
 * Class ApostasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ImpressorasRepositoryEloquent extends BaseRepository implements ImpressorasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Impressoras::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
