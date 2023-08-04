<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LancamentosCreateRequest;
use App\Http\Requests\LancamentosUpdateRequest;
use App\Repositories\LancamentosRepository;
use App\Presenters\LancamentosPresenter;
use App\Transformers\LancamentosTransformer;
use App\Validators\LancamentosValidator;

/**
 * Class LancamentosController.
 *
 * @package namespace App\Http\Controllers;
 */
class LancamentosController extends Controller
{
    /**
     * @var LancamentosRepository
     */
    protected $repository;

    /**
     * @var LancamentosValidator
     */
    protected $validator;

    /**
     * @var LancamentoTransformer
     */
    protected $transformer;

    /**
     * @var PresenterTransformer
     */
    protected $presenter;

    /**
     * LancamentosController constructor.
     *
     * @param LancamentosRepository $repository
     * @param LancamentosValidator $validator
     * @param LancamentosPresenter $presenter
     * @param LancamentosTransformer $transformer
     */
    public function __construct(LancamentosRepository $repository, LancamentosValidator $validator, LancamentosPresenter $presenter, LancamentosTransformer $transformer)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->presenter = $presenter;
        $this->transformer  = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $lancamentos = $this->repository->setPresenter($this->presenter)->paginate();

        return response()->json([
            'body' => $lancamentos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LancamentosCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LancamentosCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipo = $this->repository->create($request->all());

            return response()->json([
                'message' => 'Lançamento cadastrado com sucesso.',
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
        $lancamento = $this->repository->setPresenter($this->presenter)->find($id);

        return response()->json([
            'body' => $lancamento,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LancamentosUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LancamentosUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipo = $this->repository->update($request->all(), $id);

            return response()->json([
                'message' => 'Lançamento atualizado com sucesso.',
                'status' => 'success',
                'data'    => $tipo->toArray(),
            ]);
        } catch (ValidatorException $e) {

            return response()->json([
                'message' => 'Não foi possível atualizar o Lançamento.',
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
            'message' => 'Lançamento deletado com sucesso.',
            'deleted' => $deleted,
        ]);
    }
}
