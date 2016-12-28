<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;
use LaravelCommerce\Http\Middleware;

use Illuminate\Support\Facades\Session;

use LaravelCommerce\Order;
use LaravelCommerce\OrderItem;
use LaravelCommerce\Category;
use LaravelCommerce\Events\CheckoutEvent;

use Auth;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;
use PHPSC\PagSeguro\Purchases\Subscriptions\Locator as SubscriptionLocator;
use PHPSC\PagSeguro\Purchases\Transactions\Locator as TransactionLocator;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->afterFilter(function(){

            header("access-control-allow-origin: *");

        });
    }

    public function place(Order $orderModel, OrderItem $ordemItemMobel, CheckoutService $checkoutService)
    {
        $categories = Category::all();

    	if(!Session::has('cart')) {
    		return false;
    	}

    	$cart = Session::get('cart');

    	if($cart->getTotal() > 0) {

            $checkout = $checkoutService->createCheckoutBuilder();

    		$order = $orderModel->create(['user_id' => Auth::User()->id, 'total' => $cart->getTotal(), 'status_id' => 1]);
            $checkout->setReference($order->id);

    		foreach($cart->all() as $k => $item) {

                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'],2,'.',''), $item['qtd']));

    			$order->items()->create(['product_id'=>$k, 'price' => $item['price'], 'qtd' => $item['qtd']]);
    		}
    		
               $cart->clear();

            event(new CheckoutEvent(Auth::user(), $order));

            $response = $checkoutService->checkout($checkout->getCheckout());

    		return redirect($response->getRedirectionUrl());

    	}

        return view('store.checkout', ['order'=>'empty', 'categories' => $categories]);
    }

    public function payRedirect(Request $request, Locator $locator, Order $orderModel)
    {
        $transaction_id = $request["transaction_id"];

        $transaction = $locator->getByCode($transaction_id);
        $orderId = $transaction->getDetails()->getReference();

        $order = $orderModel->find($orderId);
        $order->transaction_id = $transaction_id;
        $order->save();

        return view('store.payredirect', ['transaction_id'=>$transaction_id]);
    }

    public function changeStatus(Request $request, SubscriptionLocator $sLocator, TransactionLocator $tLocator,  Order $orderModel)
    {
        header("access-control-allow-origin: *");

        try {
            $service = $request['notificationType'] == 'preApproval'
               ? $sLocator
               : $tLocator; // Cria instância do serviço de acordo com o tipo da notificação

            $purchase = $service->getByNotification($request['notificationCode']);

            /*
            PAID = '3';
            AVAILABLE = '4';
            UNDER_CONTEST = '5';
            RETURNED = '6';
            CANCELLED = '7';
            */
            $order = $orderModel->find($purchase->getDetails()->getReference());
            $order->status_id = $purchase->getDetails()->getStatus();
            $order->save();

        } catch (Exception $error) { // Caso ocorreu algum erro
            echo $error->getMessage(); // Exibe na tela a mensagem de erro
        }

    }

}
