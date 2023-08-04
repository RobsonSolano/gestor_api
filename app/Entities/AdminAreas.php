<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdminAreas.
 *
 * @package namespace App\Entities;
 */
class AdminAreas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'admin_areas';
    protected $fillable = ['id', 'nome', 'bloqueado', 'ordem'];
}
