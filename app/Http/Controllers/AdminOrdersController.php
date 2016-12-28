<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;

use LaravelCommerce\Order;
use LaravelCommerce\Status;

class AdminOrdersController extends Controller
{

    private $orderModel;

    public function __construct(Order $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function index()
    {
    	$orders = $this->orderModel->paginate(10);
        return view('orders.index',compact('orders'));
    }

    public function edit($id, Status $status)
    {
        $statuses = $status->lists('name','id');
        $order = $this->orderModel->find($id);
        return view('orders.edit', compact('order','statuses'));
    }

    public function update(Request $request, $id)
    {
        $this->orderModel->find($id)->update($request->all());

        return redirect()->route('orders');
    }

}
