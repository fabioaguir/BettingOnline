<?php

namespace App\Presenters;

use App\Transformers\ArrecadacoesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ArrecadacoesPresenter
 *
 * @package namespace App\Presenters;
 */
class ArrecadacoesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ArrecadacoesTransformer();
    }
}
