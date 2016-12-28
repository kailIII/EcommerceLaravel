<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use LaravelCommerce\Order;

class AccountController extends Controller
{
    public function index()
    {

    }

    public function orders()
    {
    	$orders = Auth::user()->orders;

    	return view('store.orders', compact('orders'));
    }

}
