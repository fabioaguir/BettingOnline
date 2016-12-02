<?php

namespace App\Presenters;

use App\Transformers\TimesAltaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TimesAltaPresenter
 *
 * @package namespace App\Presenters;
 */
class TimesAltaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TimesAltaTransformer();
    }
}
