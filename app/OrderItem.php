<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
    	'product_id',
    	'price',
    	'qtd'
    ];

    public function order()
    {
    	return $this->belongsTo('LaravelCommerce\Order');
    }

        public function product()
    {
        return $this->belongsTo('LaravelCommerce\Product');
    }
}
