<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Apostas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table    = 'apostas';

    /**
     * @var array
     */
    protected $fillable = [
        'venda_id',
        'partida_id',
        'cotacao_id',
        'valor'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partida()
    {
        return $this->belongsTo(Partidas::class, 'partida_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cotacao()
    {
        return $this->belongsTo(Cotacoes::class, 'cotacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venda()
    {
        return $this->belongsTo(Vendas::class, 'venda_id');
    }
}
