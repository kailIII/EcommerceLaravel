<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

class OrderNotification extends Model
{
    protected $table = 'order_notifications';

    protected $fillable = [
    	'name'
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
