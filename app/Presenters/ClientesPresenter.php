<?php

namespace App\Presenters;

use App\Transformers\ClientesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClientesPresenter.
 *
 * @package namespace App\Presenters;
 */
class ClientesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClientesTransformer();
    }
}
