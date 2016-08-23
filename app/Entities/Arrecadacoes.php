<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Softage\Uteis\SerbinarioDateFormat;

class Arrecadacoes extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'arrecadador_id',
        'vendedor_id',
        'valor',
        'data',
        'hora'
    ];

    /**
     * @return mixed
     */
    public function getHoraAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['hora'], 'time');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Vendedor
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Vendedor
     */
    public function arrecadador()
    {
        return $this->belongsTo(Arrecadador::class, 'arrecadador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Vendedor
     */
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

}
