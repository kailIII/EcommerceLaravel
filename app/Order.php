<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

use LaravelCommerce\User;
use LaravelCommerce\OrderItem;
use LaravelCommerce\OrderNotification;

class Order extends Model
{

	protected $fillable = [
		'user_id',
		'total',
		'status_id'
	];

    public function items()
    {
    	return $this->hasMany('LaravelCommerce\OrderItem');
    }

    public function notifications()
    {
        return $this->hasMany('LaravelCommerce\OrderNotification');
    }

    public function user()
    {
    	return $this->belongsTo('LaravelCommerce\User');
    }

    public function status()
    {
        return $this->belongsTo('LaravelCommerce\Status');
    }

}
