<?php

namespace App\Presenters;

use App\Transformers\TemposTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TemposPresenter
 *
 * @package namespace App\Presenters;
 */
class TemposPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TemposTransformer();
    }
}
