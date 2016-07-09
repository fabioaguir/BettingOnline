<?php

namespace App\Presenters;

use App\Transformers\PremiacoesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PremiacoesPresenter
 *
 * @package namespace App\Presenters;
 */
class PremiacoesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PremiacoesTransformer();
    }
}
