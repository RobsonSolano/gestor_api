<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdminAreasCreateRequest;
use App\Http\Requests\AdminAreasUpdateRequest;
use App\Repositories\AdminAreasRepository;
use App\Validators\AdminAreasValidator;

/**
 * Class AdminAreasController.
 *
 * @package namespace App\Http\Controllers;
 */
class AdminAreasController extends Controller
{
    /**
     * @var AdminAreasRepository
     */
    protected $repository;

    /**
     * @var AdminAreasValidator
     */
    protected $validator;

    /**
     * AdminAreasController constructor.
     *
     * @param AdminAreasRepository $repository
     * @param AdminAreasValidator $validator
     */
    public function __construct(AdminAreasRepository $repository, AdminAreasValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $adminAreas = $this->repository->all()->where('bloqueado', '=', '0');

        return response()->json([
            'data' => $adminAreas,
        ]);
    }
}
