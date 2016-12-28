@extends('layouts.admin')

@section('content')
	<div class="container">
		<h1>Create Category</h1>

		@if ($errors->any())
			<ul class="alert"> 
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach	
			</ul>	
		@endif	

		{!! Form::open(['route'=>'categories.store']) !!}

			@include('categories._form')

			<div class="form-group">
				{!! Form::submit('Add Category', ['class'=>'btn-primary' ]) !!}
			</div>
		{!! Form::close() !!}

	</div>

@endsection
