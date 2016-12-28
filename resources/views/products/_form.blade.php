<div class="form-group">
	{!! Form::label('category','Category:') !!}
	{!! Form::select('category_id', $categories, null, ['class'=>'form-control' ]) !!}
</div>

<div class="form-group">
	{!! Form::label('name','Name:') !!}
	{!! Form::text('name', null, ['class'=>'form-control' ]) !!}
</div>	

<div class="form-group">
	{!! Form::label('description','Description:') !!}
	{!! Form::textarea('description', null, ['class'=>'form-control' ]) !!}
</div>	

<div class="form-group">
	{!! Form::label('price','Price:') !!}
	{!! Form::text('price', null, ['class'=>'form-control' ]) !!}
</div>

<div class="form-group">
	{!! Form::label('featured','Featured:') !!}
	{!! Form::checkbox('featured', '1') !!}
</div>	

<div class="form-group">
	{!! Form::label('recommend','Recommend:') !!}
	{!! Form::checkbox('recommend', '1' ) !!}
</div>	

<div class="form-group">
	{!! Form::label('tags','Tags:') !!}
	{!! Form::textarea('tags', null, ['class'=>'form-control' ]) !!}
</div>