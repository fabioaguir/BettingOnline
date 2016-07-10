<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Partidas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     *
     * Nome da tabela do banco de dados
     */
    protected $table    = "partidas";

    /**
     * @var array
     *
     * Campos do tipo data
     */
    protected $dates    = [
        'data'
    ];

    /**
     * @var array
     *
     * MassAssigment
     * Campos para cadastro automático
     */
    protected $fillable = [
        'data',
        'time_casa_id',
        'tima_fora_id',
        'status_id',
        'campeonato_id'
    ];

    /**
     * @param $value
     */
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return mixed
     */
    public function getDataAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Times (da casa)
     */
    public function timeCasa()
    {
        return $this->belongsTo(Times::class, 'tima_casa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     *  Relacionamento com Times (de fora)
     */
    public function timeFora()
    {
        return $this->belongsTo(Times::class, 'tima_fora_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     *  Relacionamento com Status
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     *  Relacionamento com Camponatos
     */
    public function campeonato()
    {
        return $this->belongsTo(Campeonatos::class, 'campeonato_id');
    }
}
