<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\TimesAltaRepository;
use Softage\Entities\TimesAlta;

/**
 * Class TimesAltaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TimesAltaRepositoryEloquent extends BaseRepository implements TimesAltaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TimesAlta::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
