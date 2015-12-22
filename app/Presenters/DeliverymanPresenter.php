<?php

namespace CodeDelivery\Presenters;

use CodeDelivery\Transformers\DeliverymanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DeliverymanPresenter
 *
 * @package namespace CodeDelivery\Presenters;
 */
class DeliverymanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DeliverymanTransformer();
    }
}
