<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Chipes extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'chipes';

    protected $fillable = [
        'nome',
        'serial'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedores(){
        return $this->hasMany(Vendedor::class, 'chipe_id', 'id');
    }

}
