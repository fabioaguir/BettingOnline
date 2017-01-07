<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ConfVendas extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'conf_vendas';
    
    protected $fillable = [
        'limite_vendas',
        'comissao',
        'cotacao',
        'tipo_cotacao_id',
        'vendedor_id',
        'status_id',
        'data'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Vendedor
     */
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Status
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Tipo de cotação
     */
    public function tipoCotacao()
    {
        return $this->belongsTo(TipoCotacao::class, 'tipo_cotacao_id');
    }

}
