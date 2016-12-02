<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Vendedor extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'pessoas';

    protected $fillable = [
        'nome',
        'usuario',
        'senha',
        'status_id',
        'estorno_id',
        'area_id',
        'codigo',
        'tipo_pessoa_id',
        'chipe_id',
        'impressora_id',
        'tablet_id'
    ];

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
     * Relacionamento com Estorno
     */
    public function estorno()
    {
        return $this->belongsTo(EstornoVendedor::class, 'estorno_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Area
     */
    public function area()
    {
        return $this->belongsTo(Areas::class, 'area_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Area
     */
    public function chipe()
    {
        return $this->belongsTo(Chipes::class, 'chipe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Area
     */
    public function impressora()
    {
        return $this->belongsTo(Impressoras::class, 'impressora_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Area
     */
    public function tablet()
    {
        return $this->belongsTo(Tablests::class, 'tablet_id');
    }
    
}
