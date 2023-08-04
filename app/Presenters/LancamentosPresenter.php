<?php

namespace App\Presenters;

use App\Transformers\LancamentosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LancamentosPresenter.
 *
 * @package namespace App\Presenters;
 */
class LancamentosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LancamentosTransformer();
    }
}
