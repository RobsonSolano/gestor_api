<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdminAreasPermitidasCreateRequest;
use App\Http\Requests\AdminAreasPermitidasUpdateRequest;
use App\Repositories\AdminAreasPermitidasRepository;
use App\Validators\AdminAreasPermitidasValidator;

/**
 * Class AdminAreasPermitidasController.
 *
 * @package namespace App\Http\Controllers;
 */
class AdminAreasPermitidasController extends Controller
{
    /**
     * @var AdminAreasPermitidasRepository
     */
    protected $repository;

    /**
     * @var AdminAreasPermitidasValidator
     */
    protected $validator;

    /**
     * AdminAreasPermitidasController constructor.
     *
     * @param AdminAreasPermitidasRepository $repository
     * @param AdminAreasPermitidasValidator $validator
     */
    public function __construct(AdminAreasPermitidasRepository $repository, AdminAreasPermitidasValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $adminAreasPermitidas = $this->repository->all()->where('auth_admin_id', '=', $user_id);

        return response()->json([
            'data' => $adminAreasPermitidas,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function has_permission($user_id, $area_id)
    {
        $adminAreasPermitida = $this->repository->findWhere(array(
            'auth_admin_id' => $user_id,
            'admin_area_id' => $area_id
        ))->all();

        $data = false;

        if (!empty($adminAreasPermitida)) {
            $data = true;
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function salvar(Request $request)
    {
        $user_id = $request->user_id;
        $areas = str_replace('{', '', $request->permissao);
        $areas = str_replace('}', '', $areas);
        $areas = explode(',', $areas);

        try {

            $this->repository->where('auth_admin_id', '=', $user_id)->delete();

            foreach ($areas as $key => $value) {
                $this->repository->create([
                    'auth_admin_id' => $user_id,
                    'admin_area_id' => $value
                ]);
            }

            $response = [
                'message' => 'Permissões atualizadas com sucesso.',
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }
}
