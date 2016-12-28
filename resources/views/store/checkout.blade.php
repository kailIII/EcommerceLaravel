@extends('store.store')

@section('content')
	<div class="container">

		@if ($order == 'empty')
			<h3>Cart is empty</h3>
		@else
			<h3>Order placed!</h3>

			<p>Order  #{{ $order->id }} created!</p>
		@endif

	</div>
@stop