<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Admin_areasRepository;
use App\Entities\AdminAreas;
use App\Validators\AdminAreasValidator;

/**
 * Class AdminAreasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminAreasRepositoryEloquent extends BaseRepository implements AdminAreasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminAreas::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminAreasValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
