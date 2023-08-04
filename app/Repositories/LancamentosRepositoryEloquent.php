<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LancamentosRepository;
use App\Entities\Lancamentos;
use App\Validators\LancamentosValidator;

/**
 * Class LancamentosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LancamentosRepositoryEloquent extends BaseRepository implements LancamentosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lancamentos::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LancamentosValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
