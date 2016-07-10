<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Areas extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'areas';
    
    protected $fillable = [
        'nome',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedores(){
        return $this->hasMany(Vendedor::class, 'area_id', 'id');
    }
}
