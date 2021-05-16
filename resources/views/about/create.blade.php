@extends('layouts.app')

@section('content')
<h1> Create About Us detail</h1>
<form class="form" action="{{route('about.store')}}" method="POST" enctype="multipart/form-data"> 
	@csrf
	<div class="col-md-12">
		<div class="form-group">
			<label>Title</label>
			<input type="text" name="title" class="form-control" placeholder="Title">
		</div>
		<div class="form-group">
			<label>Body</label>
			<textarea class="form-control" name="body">
			</textarea>
		</div>
		<div class="form-group">
			<input type="file" name="image">
		</div>
	</div>
	<button class="submit btn btn-primary">Submit</button>
</form>
@endsection