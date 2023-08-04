<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClientesCreateRequest;
use App\Http\Requests\ClientesUpdateRequest;
use App\Repositories\ClientesRepository;
use App\Validators\ClientesValidator;

/**
 * Class ClientesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClientesController extends Controller
{
    /**
     * @var ClientesRepository
     */
    protected $repository;

    /**
     * @var ClientesValidator
     */
    protected $validator;

    /**
     * ClientesController constructor.
     *
     * @param ClientesRepository $repository
     * @param ClientesValidator $validator
     */
    public function __construct(ClientesRepository $repository, ClientesValidator $validator)
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
        $clientes = $this->repository->paginate();

        return response()->json([
            'body' => $clientes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ClientesCreateRequest $request)
    {
        $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

        $tipo = $this->repository->create($request->all());

        return response()->json([
            'message' => 'Cliente cadastrado com sucesso.',
            'status' => 'success',
            'data'    => $tipo->toArray(),
        ]);
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
        $cliente = $this->repository->find($id);

        return response()->json([
            'body' => $cliente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ClientesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipo = $this->repository->update($request->all(), $id);

            return response()->json([
                'message' => 'Cliente atualizado com sucesso.',
                'status' => 'success',
                'data'    => $tipo->toArray(),
            ]);
        } catch (ValidatorException $e) {

            return response()->json([
                'message' => 'Não foi possível atualizar o Cliente.',
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
            'message' => 'Cliente deletado com sucesso.',
            'deleted' => $deleted,
        ]);
    }
}
