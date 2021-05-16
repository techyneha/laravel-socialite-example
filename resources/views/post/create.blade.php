@extends('layouts.app')

@section('content')
	<h1>Create Post</h1>
	<form class="form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="container">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control">
			</div>
			<div class="form-group">
				<label>Body</label>
				<textarea name="body" id="article-ckeditor" rows="5" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label>File upload</label>
				<input type="file" name="cover_image" class="form-control">
			</div>
			<div class="form-group">
				{{-- <input type="submit" name="submit" value="Submit" class="btn btn-primary"> --}}
				<button type="submit" class="btn btn-primary">Submit </button> 
			</div>
		</div>
	</form>
@endsection