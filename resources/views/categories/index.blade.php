@extends('layouts.admin')

@section('content')
	<div class="container">
		<h1>Categories</h1>

		<br />
		<a href="{{ route('categories.create')}}" class="btn btn-primary">New Category</a>

		<table class="table">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
			@foreach($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>{{ $category->description}}</td>
					<td>
						<a class="btn btn-success" href="{{ route('categories.edit',['id'=>$category->id]) }}">Edit</a>
						<a class="btn btn-danger" href="{{ route('categories.destroy',['id'=>$category->id]) }}" onclick="if(confirm('Are you sure?')) { return true } else {return false };" >Delete</a>
					</td>
				</tr>
			@endforeach
		</table>
		{!! $categories->render() !!}
	</div>

@endsection

