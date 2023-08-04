<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AdminAreas;

/**
 * Class AdminAreasTransformer.
 *
 * @package namespace App\Transformers;
 */
class AdminAreasTransformer extends TransformerAbstract
{
    /**
     * Transform the AdminAreas entity.
     *
     * @param \App\Entities\AdminAreas $model
     *
     * @return array
     */
    public function transform(AdminAreas $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'      => $model->nome,
            'bloqueado' => $model->bloqueado,
            'ordem' => $model->ordem
        ];
    }
}
