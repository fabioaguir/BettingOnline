<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Softage\Uteis\SerbinarioDateFormat;

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
        'hora',
        'time_casa_id',
        'time_fora_id',
        'status_id',
        'campeonato_id',
        'simples',
        'sete_da_sorte',
        'sete_sorte_obr',
        'processada_id',
        'limite_valor_aposta',
        'bloq_por_limite_valor_aposta'
    ];

    /**
     * @param $value
     */
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = SerbinarioDateFormat::toUsa($value, 'date');
    }

    /**
     * @return mixed
     */
    public function getDataAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data'], 'date');
    }

  
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
     * Relacionamento com Times (da casa)
     */
    public function casa()
    {
        return $this->belongsTo(Times::class, 'time_casa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relacionamento com Times (de fora)
     */
    public function fora()
    {
        return $this->belongsTo(Times::class, 'time_fora_id');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apostas()
    {
        return $this->hasMany(Apostas::class, 'partida_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gols()
    {
        return $this->hasMany(Gols::class, 'partida_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotacoes()
    {
        return $this->hasMany(Cotacoes::class, 'partida_id');
    }
}
