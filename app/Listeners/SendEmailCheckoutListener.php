<?php

namespace LaravelCommerce\Listeners;

use LaravelCommerce\Events\CheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

class SendEmailCheckoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        $user = $event->getUser();
        $order = $event->getOrder();

        Mail::send('emails.checkout', compact(['user','order']), function ($message) use ($user, $order) {
                $message->from('fromemail@fromemail.com', 'Name');
                $message->to('toemeail@toemail.com')->subject('Order ' . $order->id . ' placed');
        });
    }
}
