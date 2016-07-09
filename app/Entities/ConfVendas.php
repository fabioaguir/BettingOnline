<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ConfVendas extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'limite_vendas',
        'comissao',
        'cotacao',
        'tipo_cotacao_id',
        'vendedor_id',
        'vendas_id'
    ];

}
