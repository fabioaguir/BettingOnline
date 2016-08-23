<?php

namespace Softage\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Vendas extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'vendas';
    
    protected $fillable = [
        'status_v_id',
        'seq',
        'data',
        'obs',
        'valor_total',
        'retorno',
        'premiacao_id',
        'tipo_aposta_id',
        'conf_venda_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedores(){
        return $this->hasMany(Vendedor::class, 'area_id', 'id');
    }
}
