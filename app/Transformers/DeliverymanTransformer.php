<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\User;

/**
 * Class DeliverymanTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class DeliverymanTransformer extends TransformerAbstract
{
    /**
     * Transform the \User entity
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model) {
        return [
            'id'    => (int)$model->id,
            'name'  => $model->name,
            'email' => $model->email,
        ];
    }
}