<?php

namespace App\Presenters;

use App\Transformers\AdminAreasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdminAreasPresenter.
 *
 * @package namespace App\Presenters;
 */
class AdminAreasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminAreasTransformer();
    }
}
