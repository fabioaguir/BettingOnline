<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Arrecadador extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'pessoas';

    protected $fillable = [
        'nome',
        'usuario',
        'senha',
        'status_id',
        'codigo',
        'tipo_pessoa_id'
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
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeArrecadadores($query, $value)
    {
        return $query
            ->select(['id', 'nome'])
            ->where('tipo_pessoa_id', 2);
    }

}
