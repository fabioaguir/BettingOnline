<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\timesRepository;
use Softage\Entities\Times;

/**
 * Class TimesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TimesRepositoryEloquent extends BaseRepository implements TimesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Times::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
