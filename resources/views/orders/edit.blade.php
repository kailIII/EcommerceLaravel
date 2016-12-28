@extends('layouts.admin')

@section('content')
	<div class="container">
		<h1>Editing Order: {{ $order->id }}</h1>

		@if ($errors->any())
			<ul class="alert"> 
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach	
			</ul>	
		@endif	

		{!! Form::model($order, ['route'=>['orders.update', $order->id], 'method' => 'put']) !!}

			<div class="form-group">
				{!! Form::label('status_id','Status:') !!}
				{!! Form::select('status_id', $statuses, $order->status_id, ['class'=>'form-control' ]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Save Order', ['class'=>'btn-primary' ]) !!}
			</div>	
		{!! Form::close() !!}

	</div>

@endsection
