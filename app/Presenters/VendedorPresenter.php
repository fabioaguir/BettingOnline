<?php

namespace App\Presenters;

use App\Transformers\VendedorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VendedorPresenter
 *
 * @package namespace App\Presenters;
 */
class VendedorPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VendedorTransformer();
    }
}
