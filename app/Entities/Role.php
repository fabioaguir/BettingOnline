<?php

namespace Seracademico\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Role extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'level'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission ::class);
    }
}
