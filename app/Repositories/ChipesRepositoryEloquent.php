<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\ChipesRepository;
use Softage\Entities\Chipes;

/**
 * Class ApostasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ChipesRepositoryEloquent extends BaseRepository implements ChipesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chipes::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
