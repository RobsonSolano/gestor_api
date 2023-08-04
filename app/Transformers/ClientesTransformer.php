<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Clientes;
use Illuminate\Support\Carbon;

/**
 * Class ClientesTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClientesTransformer extends TransformerAbstract
{
    /**
     * Transform the Clientes entity.
     *
     * @param \App\Entities\Clientes $model
     *
     * @return array
     */
    public function transform(Clientes $model)
    {
        return [
            'codigo'         => (int) $model->id,
            'nome' => $model->nome,
            'is_familiar' => $model->is_familiar == 0 ? 'Não' : 'Sim',
            'Cadastrado em' => Carbon::parse($model->data_cricao)->format('d-m-Y')
        ];
    }
}
