<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;

use LaravelCommerce\Cart;
use LaravelCommerce\Product;

use LaravelCommerce\Http\Requests\CartRequest;

class CartController extends Controller
{

	private $cart;

	public function __construct(Cart $cart)
	{
		$this->cart = $cart;
	}

    public function index()
    {
    	if(!Session::has('cart')) {
    		Session::set('cart', $this->cart);
    	}

    	return view('store.cart', ['cart' => Session::get('cart')] );
    }

    public function add($id)
    {
    	$cart =$this->getCart();

    	$product = Product::find($id);
    	$cart->add($id, $product->name, $product->price);
    	Session::set('cart',$cart);

    	return redirect()->route('cart');

    }

    public function update(CartRequest $request)
    {
        $input = $request->all();
        $cart =$this->getCart();

        $itemJSON = $cart->update($input['id'], $input['qtd']);

        Session::set('cart',$cart);

        return $itemJSON;
    }

    public function destroy($id)
    {
    	$cart =$this->getCart();
    	$cart->remove($id);
    	Session::set('cart',$cart);
    	return redirect()->route('cart');
    }

    private function getCart()
    {
    	if(Session::has('cart')) {
    		$cart = Session::get('cart');
    	} else {
    		$cart = $this->cart;
    	}
    	return $cart;
    }


}
