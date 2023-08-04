<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Admin_areas_permitidasRepository;
use App\Entities\AdminAreasPermitidas;
use App\Validators\AdminAreasPermitidasValidator;

/**
 * Class AdminAreasPermitidasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminAreasPermitidasRepositoryEloquent extends BaseRepository implements AdminAreasPermitidasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminAreasPermitidas::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminAreasPermitidasValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
