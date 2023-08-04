<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TiposCreateRequest;
use App\Http\Requests\TiposUpdateRequest;
use App\Repositories\TiposRepository;
use App\Validators\TiposValidator;
use App\Presenters\TiposPresenter;
use Illuminate\Support\Facades\Auth;

/**
 * Class TiposController.
 *
 * @package namespace App\Http\Controllers;
 */
class TiposController extends Controller
{
    /**
     * @var TiposRepository
     */
    protected $repository;

    /**
     * @var TiposValidator
     */
    protected $validator;

    /**
     * @var TiposPresenter
     */
    protected $presenter;

    /**
     * TiposController constructor.
     *
     * @param TiposRepository $repository
     * @param TiposValidator $validator
     */
    public function __construct(TiposRepository $repository, TiposValidator $validator, TiposPresenter $presenter)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->presenter  = $presenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $tipos = $this->repository->setPresenter($this->presenter)->where('auth_admin_id', '=', Auth::user()->id)->paginate();

        return response()->json([
            'body' => $tipos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TiposCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TiposCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipo = $this->repository->create($request->all());

            return response()->json([
                'message' => 'Tipo de lançamento cadastrado com sucesso.',
                'status' => 'success',
                'data'    => $tipo->toArray(),
            ]);
        } catch (ValidatorException $e) {

            return response()->json([
                'message' => 'Não foi possível cadastrar.',
                'status' => 'error',
                'error' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = $this->repository->setPresenter($this->presenter)->find($id);

        return response()->json([
            'body' => $tipo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TiposUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TiposUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipo = $this->repository->where('auth_admin_id', '=', Auth::user()->id)->update($request->all(), $id);

            return response()->json([
                'message' => 'Tipo atualizado com sucesso.',
                'status' => 'success',
                'data'    => $tipo->toArray(),
            ]);
        } catch (ValidatorException $e) {

            return response()->json([
                'message' => 'Não foi possível atualizar o tipo.',
                'status' => 'error',
                'error' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return response()->json([
            'message' => 'Tipo deletado com sucesso.',
            'deleted' => $deleted,
        ]);
    }
}
