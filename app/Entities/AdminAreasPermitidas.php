<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdminAreasPermitidas.
 *
 * @package namespace App\Entities;
 */
class AdminAreasPermitidas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "admin_areas_permitidas";
    protected $fillable = ['id', 'auth_admin_id', 'admin_area_id'];
}
