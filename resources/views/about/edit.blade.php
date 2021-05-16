@extends('layouts.app')

@section('content')
<h1> Edit About Us detail</h1>
<form class="form" action="{{route('about.update')}}" method="POST" enctype="multipart/form-data"> 
	@csrf
	<div class="col-md-12">
		<div class="form-group">
			<label>Title</label>
			<input type="text" name="title" class="form-control" value="{{$about->title}}" placeholder="Title">
		</div>
		<div class="form-group">
			<label>Body</label>
			<textarea class="form-control" name="body">
				{{$about->body}}
			</textarea>
		</div>
		<div class="form-group">
			<input type="file" name="image">
		</div>
		<input type="hidden" name="id" value="{{$about->id}}">
	</div>
	<button class="submit btn btn-primary">Update</button>
</form>
@endsection