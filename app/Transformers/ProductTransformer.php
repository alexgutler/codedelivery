<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Product;

/**
 * Class ProductTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['category']; // serializa por padrão
    /**
     * Transform the \Product entity
     * @param Product $model
     *
     * @return array
     */
    public function transform(Product $model) {
        return [
            'id'    => (int)$model->id,
            'name'  => $model->name,
            'description'  => $model->description,
            'price' => (float)$model->price
        ];
    }

    public function includeCategory(Product $model)
    {
        if(!$model->category){
            return null;
        }
        return $this->item($model->category, new CategoryTransformer());
    }
}