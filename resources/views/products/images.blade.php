@extends('layouts.admin')

@section('content')
	<div class="container">
		<h1>Product : {{ $product->name }} </h1>

		<br />
		<a href="{{ route('products.images.create',['id'=>$product->id]) }}" class="btn btn-default">New Image</a>

		<table class="table">
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Extension</th>
				<th>Action</th>
			</tr>
			@foreach($product->images as $image)
				<tr>
					<td>{{ $image->id }}</td>
					<td><img src="{{ url('uploads/'.$image->id.'.'.$image->extension) }}" width=80></td>
					<td>{{ $image->extension }}</td>
					<td>
						<a class="btn btn-danger" href="{{ route('products.images.destroy', ['id'=>$image->id]) }}" onclick="if(confirm('Are you sure?')) { return true } else {return false };">Delete</a>
					</td>

				</tr>
			@endforeach
		</table>

		<a href="{{ route('products' )}}" class="btn btn-default">Back</a>

	</div>

@endsection