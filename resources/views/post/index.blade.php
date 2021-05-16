@extends('layouts.app')

@section('content')
	<h1>Posts</h1>
	@if(count($posts) > 1)
		@foreach($posts as $post)
			{{-- @if(auth()->user()->id == $post->user_id) --}}
			<div class="well1">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						@if(!empty($post->cover_image))
						<img style="width: 100%;" src="{{ url('/blog_img/'.$post->cover_image ) }}">
						@endif
					</div>
					<div class="col-md-4 col-sm-4">
						<h3><a href="{{ route('posts.show',['post'=>$post->id]) }}">{{ ucwords($post->title) }}</a></h3>
						<small>Written On {{ $post->created_at }} by {{ ucwords($post->user->name) }}</small>
					</div>
				</div>
				
			</div>
			{{-- @else
				<div class="well1">
					<p>No Posts Added</p>
				</div>
			@endif --}}
		@endforeach
		{{ $posts->links()}}
	@else
		<p>No Post found</p>
	@endif
	{{-- {{ $post->$links(); }} --}}
@endsection