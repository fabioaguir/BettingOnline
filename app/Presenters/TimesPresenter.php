<?php

namespace App\Presenters;

use App\Transformers\TimesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TimesPresenter
 *
 * @package namespace App\Presenters;
 */
class TimesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TimesTransformer();
    }
}
