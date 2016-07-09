<?php

namespace App\Presenters;

use App\Transformers\EstornoVendedorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EstornoVendedorPresenter
 *
 * @package namespace App\Presenters;
 */
class EstornoVendedorPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EstornoVendedorTransformer();
    }
}
