<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Lancamentos;
use Illuminate\Support\Carbon;

use App\Helpers;

/**
 * Class LancamentosTransformer.
 *
 * @package namespace App\Transformers;
 */
class LancamentosTransformer extends TransformerAbstract
{
    /**
     * Transform the Lancamentos entity.
     *
     * @param \App\Entities\Lancamentos $model
     *
     * @return array
     */
    public function transform(Lancamentos $model)
    {
        return [
            'Codigo' => (int) $model->id,
            'Tipo'  => $model->tipo_titulo,
            'Titulo do Lançamento' => $model->titulo,
            'Valor do Lançamento' => 'R$ ' . number_format($model->valor, 2, ',', '.'),
            'Descrição do Lançamento' => $model->descricao,
            'Cadastrado em' => Carbon::parse($model->data_cricao)->format('d-m-Y'),
            'Data do Lançamento' => Carbon::parse($model->lancamento_data)->format('d-m-Y'),
            'Pago em' => Carbon::parse($model->lancamento_data_pagamento)->format('d-m-Y'),
        ];
    }
}
