<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cotacoes extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'cotacoes';

    protected $fillable = [
        'valor',
        'partida_id',
        'modalidade_id',
        'status_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modalidade()
    {
        return $this->belongsTo(Modalidades::class, 'modalidade_id');
    }

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
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apostas()
    {
        return $this->hasMany(Apostas::class, 'cotacao_id');
    }
}
