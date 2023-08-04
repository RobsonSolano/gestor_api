<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;

/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 02/12/2016
 * Time: 15:22
 */
class NonDeletedScope implements Scope
{
    public function apply(\Illuminate\Database\Eloquent\Builder $builder, \Illuminate\Database\Eloquent\Model $model)
    {
        $builder->where($model->getTable() . '.deletado', '=', '0');
    }
}
