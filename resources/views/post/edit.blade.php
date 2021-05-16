@extends('layouts.app')

@section('content')
	<h1>Edit Post</h1>
	<form class="form" action="{{ route('posts.update',['post'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
		@csrf
		{{ method_field('PATCH') }}
		<div class="container">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" value="{{$post->title}}" class="form-control">
			</div>
			<div class="form-group">
				<label>Body</label>
				<textarea name="body" id="article-ckeditor" rows="5" class="form-control">{{$post->body}}</textarea>
			</div>
				<div class="form-group">
				<label>File upload</label>
				<input type="file" name="cover_image" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update </button> 
			</div>
		</div>
	</form>
@endsection