<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TiposRepository;
use App\Entities\Tipos;
use App\Validators\TiposValidator;

/**
 * Class TiposRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TiposRepositoryEloquent extends BaseRepository implements TiposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tipos::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TiposValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
