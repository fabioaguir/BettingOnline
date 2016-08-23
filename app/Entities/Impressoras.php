<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Impressoras extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'impressoras';

    protected $fillable = [
        'nome'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedores(){
        return $this->hasMany(Vendedor::class, 'impressora_id', 'id');
    }
}
