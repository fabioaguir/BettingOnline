<?php

namespace Softage\Transformers;

use League\Fractal\TransformerAbstract;
use Softage\Entities\Areas;

/**
 * Class AreasTransformer
 * @package namespace App\Transformers;
 */
class AreasTransformer extends TransformerAbstract
{

    /**
     * Transform the \Areas entity
     * @param \Areas $model
     *
     * @return array
     */
    public function transform(Areas $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
