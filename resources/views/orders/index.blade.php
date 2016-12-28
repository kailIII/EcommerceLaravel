@extends('layouts.admin')

@section('content')
	<div class="container">

		<h3>Orders</h3>

		<table class="table">
			<tbody>
				<tr>
					<th>#ID</th>
					<th>Items</th>
					<th>Total</th>
					<th>Transaction ID</th>
					<th>Status</th>
					<th>Action</th>
				</tr>

				@foreach($orders as $order)
					<tr>
						<td>{{ $order->id }}</td>
						<td>
							<ul>
								@foreach($order->items as $item)
									<li>{{ $item->product->name }}</li>
								@endforeach
							</ul>
						</td>
						<td>{{ $order->total }}</td>
						<td>{{ $order->transaction_id }}</td>
						<td>{{ $order->status->name }}</td>
						<td><a class="btn btn-success" href="{{ route('orders.edit',['id'=>$order->id]) }}">Edit</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
@stop