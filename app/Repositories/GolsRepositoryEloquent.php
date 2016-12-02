<?php

namespace Softage\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Softage\Repositories\GolsRepository;
use Softage\Entities\Gols;
use Softage\Validators\GolsValidator;

/**
 * Class GolsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GolsRepositoryEloquent extends BaseRepository implements GolsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Gols::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return GolsValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
