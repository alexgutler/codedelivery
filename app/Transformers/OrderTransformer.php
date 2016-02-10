<?php
namespace CodeDelivery\Transformers;

use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = ['cupom', 'items']; // serializa por padrão
    protected $availableIncludes = ['cupom', 'items', 'client', 'deliveryman'];  // serializa por demanda

    /**
     * Transform the \Order entity
     * @param Order $model
     *
     * @return array
     */
    public function transform(Order $model) {
        return [
            'id'      => (int)$model->id,
            'total'   => (float)$model->total,
            'status'  => (int)$model->status,
            'product_names' => $this->getArrayProductNames($model->items),
//            'created_at' => date_format($model->created_at, "d-m-Y"),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

    protected function getArrayProductNames(Collection $items)
    {
        $names = [];
        foreach($items as $item){
            $names[] = $item->product->name;
        }
        return $names;
    }

    public function includeClient(Order $model)
    {
        if(!$model->client){
            return null;
        }
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeDeliveryman(Order $model)
    {
        if(!$model->deliveryman){
            return null;
        }
        return $this->item($model->deliveryman, new DeliverymanTransformer());
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