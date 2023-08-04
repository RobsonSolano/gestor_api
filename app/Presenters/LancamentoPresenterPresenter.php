<?php

namespace App\Presenters;

use App\Transformers\LancamentoPresenterTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LancamentoPresenterPresenter.
 *
 * @package namespace App\Presenters;
 */
class LancamentoPresenterPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LancamentoPresenterTransformer();
    }
}
