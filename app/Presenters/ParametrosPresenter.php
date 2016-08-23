<?php

namespace App\Presenters;

use App\Transformers\ParametrosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ParametrosPresenter
 *
 * @package namespace App\Presenters;
 */
class ParametrosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ParametrosTransformer();
    }
}
