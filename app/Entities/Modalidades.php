<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Softage\Entities\Status;

class Modalidades extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table    = 'modalidades';

    /**
     * @var array
     */
    protected $fillable = [
        'nome',
        'status_id',
        'limite_cotacao',
        'gols_casa',
        'gols_fora',
        'tipo_inducao_id',
        'gols_inducao'
    ];

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
    public function cotacoes()
    {
        return $this->hasMany(Cotacoes::class, 'modalidade_id');
    }
}
