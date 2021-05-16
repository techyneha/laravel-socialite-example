@extends('layouts.app')

@section('content')
	<a href="{{ url('/about') }}" class="btn btn-success">Go Back</a>
	<h1>{{ $about->title }}</h1>
	@if(!empty($about->image))
		<img style="width: 50%;" src="{{ url('/about/'.$about->image ) }} ">
	@endif
	<div class="well">
		{!! $about->body !!}
	</div>
	<hr>
	
			<div class="row" style="padding: 10px;">
				<span style="margin-right:5px;">
					<a href="{{ route('about.edit',['about'=>$about->id]) }}" class="btn btn-primary">Edit</a>
				</span>
				{{-- <form method="POST" action="{{ route('about.destroy',['post'=>$post->id]) }}">
					@csrf
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-danger">Delete</button>
				</form> --}}
			</div>
	<hr>
	
@endsection