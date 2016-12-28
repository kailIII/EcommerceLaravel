@extends('layouts.admin')

@section('content')
	<div class="container">
		<h1>Products</h1>

		<br />
		<a href="{{ route('products.create')}}" class="btn btn-primary">New Product</a>
		

		<table class="table">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Category</th>
				<th>Featured</th>
				<th>Recommend</th>
				<th>Action</th>
			</tr>
			@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->description}}</td>
					<td>{{ $product->price}}</td>
					<td>{{ $product->category->name}}</td>
					<td>{{ $product->featured}}</td>
					<td>{{ $product->recommend}}</td>
					<td>
						<a class="btn btn-success" href="{{ route('products.edit',['id'=>$product->id]) }}">Edit</a>
						<a class="btn btn-default" href="{{ route('products.images',['id'=>$product->id]) }}">Images</a>
						<a class="btn btn-danger" href="{{ route('products.destroy',['id'=>$product->id]) }}" onclick="if(confirm('Are you sure?')) { return true } else {return false };">Delete</a>
					</td>
				</tr>
			@endforeach	
		</table>
		{!! $products->render() !!}
	</div>

@endsection