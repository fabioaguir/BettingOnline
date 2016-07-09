<?php

namespace App\Presenters;

use App\Transformers\ConfVendasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ConfVendasPresenter
 *
 * @package namespace App\Presenters;
 */
class ConfVendasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ConfVendasTransformer();
    }
}
