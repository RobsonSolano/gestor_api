<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AdminAreasPermitidas;

/**
 * Class AdminAreasPermitidasTransformer.
 *
 * @package namespace App\Transformers;
 */
class AdminAreasPermitidasTransformer extends TransformerAbstract
{
    /**
     * Transform the AdminAreasPermitidas entity.
     *
     * @param \App\Entities\AdminAreasPermitidas $model
     *
     * @return array
     */
    public function transform(AdminAreasPermitidas $model)
    {
        return [
            'id'         => (int) $model->id,
            'auth_admin_id,' => (int) $model->auth_admin_id,
            'admin_area_id' => (int) $model->admin_area_id
        ];
    }
}
