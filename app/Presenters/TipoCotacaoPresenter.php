<?php

namespace App\Presenters;

use App\Transformers\TipoCotacaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoCotacaoPresenter
 *
 * @package namespace App\Presenters;
 */
class TipoCotacaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoCotacaoTransformer();
    }
}
