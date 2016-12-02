<?php

namespace App\Presenters;

use App\Transformers\TipoApostasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoApostasPresenter
 *
 * @package namespace App\Presenters;
 */
class TipoApostasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoApostasTransformer();
    }
}
