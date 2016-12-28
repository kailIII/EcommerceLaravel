@extends('store.store')

@section('content')
	<div class="container">

		<h3>Thank you. Your order was placed.</h3>
		<h4>The transaction ID is {{ $transaction_id}}.</h4>

	</div>
@stop