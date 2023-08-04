<?php

namespace App\Entities;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\NonDeletedScope;


/**
 * Class Lancamentos.
 *
 * @package namespace App\Entities;
 */
class Lancamentos extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'auth_admin_id',
        'tipo_id',
        'titulo',
        'valor',
        'lancamento_data',
        'lancamento_data_pagamento',
        'descricao',
        'deletado',
        'data_criacao'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NonDeletedScope());

        static::addGlobalScope('clientes', function (Builder $builder) {
            $builder->select($builder->getModel()->getTable() . '.*', 'lancamento_categorias.titulo AS tipo_titulo')
                ->join('lancamento_categorias', 'lancamento_categorias.id', '=', $builder->getModel()->getTable() . '.tipo_id')
                ->where('lancamentos.deletado', '=', '0')
                ->where($builder->getModel()->getTable() . '.auth_admin_id', '=', Auth()->user()->id);
        });
    }

    public function tipo()
    {
        return $this->hasMany(Tipos::class);
    }
}
