<?php

namespace App\Presenters;

use App\Transformers\AreasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AreasPresenter
 *
 * @package namespace App\Presenters;
 */
class AreasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AreasTransformer();
    }
}
