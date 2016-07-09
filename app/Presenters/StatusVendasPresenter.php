<?php

namespace App\Presenters;

use App\Transformers\StatusVendasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatusVendasPresenter
 *
 * @package namespace App\Presenters;
 */
class StatusVendasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StatusVendasTransformer();
    }
}
