<?php

namespace App\Presenters;

use App\Transformers\AdminAreasPermitidasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdminAreasPermitidasPresenter.
 *
 * @package namespace App\Presenters;
 */
class AdminAreasPermitidasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminAreasPermitidasTransformer();
    }
}
