<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'orders';
    protected $fillable = ['client_id', 'cupom_id', 'user_deliveryman_id', 'total', 'status'];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function cupom(){
        return $this->hasOne(Cupom::class, 'cupom_id', 'id');
    }

    public function deliveryman(){
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id'); // defini os campos da relação
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
