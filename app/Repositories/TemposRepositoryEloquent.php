<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\temposRepository;
use Softage\Entities\Tempos;

/**
 * Class TemposRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TemposRepositoryEloquent extends BaseRepository implements TemposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tempos::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
