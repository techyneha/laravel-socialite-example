@extends('layouts.app')

@section('content')
	<a href="{{ url('/posts') }}" class="btn btn-success">Go Back</a>
	<h1>{{ $post->title }}</h1>
	@if(!empty($post->cover_image))
		<img style="width: 50%;" src="{{ url('/blog_img/'.$post->cover_image ) }} ">
	@endif
	<div class="well">
		{!! $post->body !!}
	</div>
	<hr>
	<small>Written On {{ $post->created_at }} by {{ ucwords($post->user->name) }}</small>
	
	@if(!Auth::guest())
		@if(Auth::user()->id == $post->user_id)
			<div class="row" style="padding: 10px;">
				<span style="margin-right:5px;">
					<a href="{{ route('posts.edit',['post'=>$post->id]) }}" class="btn btn-primary">Edit</a>
				</span>
				<form method="POST" action="{{ route('posts.destroy',['post'=>$post->id]) }}">
					@csrf
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>
			</div>
		@endif
	@endif
	<hr>
	
@endsection