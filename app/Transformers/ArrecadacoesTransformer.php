<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Arrecadacoes;

/**
 * Class ArrecadacoesTransformer
 * @package namespace App\Transformers;
 */
class ArrecadacoesTransformer extends TransformerAbstract
{

    /**
     * Transform the \Arrecadacoes entity
     * @param \Arrecadacoes $model
     *
     * @return array
     */
    public function transform(Arrecadacoes $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
