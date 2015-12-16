<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = ['cupom', 'items']; // serializa por padrão
    protected $availableIncludes = ['cupom', 'items'];  // serializa por demanda

    /**
     * Transform the \Order entity
     * @param Order $model
     *
     * @return array
     */
    public function transform(Order $model) {
        return [
            'id'         => (int)$model->id,
            'total'      => (float)$model->total,
            /* place your other model properties here */
            'created_at' => date_format($model->created_at, "d/m/Y"),
            'updated_at' => date_format($model->updated_at, "d/m/Y"),
        ];
    }

    public function includeCupom(Order $model)
    {
        if(!$model->cupom){
            return null;
        }
        return $this->item($model->cupom, new CupomTransformer());
    }

    public function includeItems(Order $model)
    {
        if(!$model->items){
            return null;
        }
        return $this->collection($model->items, new OrderItemTransformer());
    }
}