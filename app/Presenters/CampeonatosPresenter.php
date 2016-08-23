<?php

namespace App\Presenters;

use App\Transformers\CampeonatosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CampeonatosPresenter
 *
 * @package namespace App\Presenters;
 */
class CampeonatosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CampeonatosTransformer();
    }
}
