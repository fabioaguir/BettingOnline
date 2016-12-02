<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Campeonatos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'campeonatos';
    
    protected $fillable = [
        'nome'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partidas(){
        return $this->hasMany(Partidas::class, 'campeonato_id', 'id');
    }
}
