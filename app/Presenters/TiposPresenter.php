<?php

namespace App\Presenters;

use App\Transformers\TiposTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TiposPresenter.
 *
 * @package namespace App\Presenters;
 */
class TiposPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TiposTransformer();
    }
}
