@extends('layouts.admin')

@section('content')
	<div class="container">
		<h1>Create Product</h1>

		@if ($errors->any())
			<ul class="alert"> 
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach	
			</ul>	
		@endif	

		{!! Form::open(['route'=>'products.store']) !!}

			@include('products._form')

			<div class="form-group">
				{!! Form::submit('Add product', ['class'=>'btn-primary' ]) !!}
			</div>	
		{!! Form::close() !!}

	</div>

@endsection
