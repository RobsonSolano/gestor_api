<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Tipos;

/**
 * Class TiposTransformer.
 *
 * @package namespace App\Transformers;
 */
class TiposTransformer extends TransformerAbstract
{
    /**
     * Transform the Tipos entity.
     *
     * @param \App\Entities\Tipos $model
     *
     * @return array
     */
    public function transform(Tipos $model)
    {
        return [
            'codigo'     => (int) $model->id,
            'admin' => $model->auth_admin_id,
            'titulo' => $model->titulo
        ];
    }
}
