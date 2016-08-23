<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TimesAlta extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'times_alta';

    protected $fillable = [
        'time_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function time()
    {
        return $this->belongsTo(Times::class, 'time_id');
    }
}
