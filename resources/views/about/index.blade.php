@extends('layouts.app')

@section('content')
<h1>About Us Page</h1>

	<div class="container">
		<a href="{{route('about.create')}}" class="btn btn-primary">Add new </a>
		<?php foreach($about as $value) { ?>
		<h4>{{$value->id}}</h4>
		<p>{{$value->title}}</p>
		<p>{{$value->body}}</p>

<hr>
	
			<div class="row" style="padding: 10px;">
				<span style="margin-right:5px;">
					<a href="{{ route('about.edit',['about'=>$value->id]) }}" class="btn btn-primary">Edit</a>
				</span>
				{{-- <form method="POST" action="{{ route('about.destroy',['post'=>$post->id]) }}">
					@csrf
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-danger">Delete</button>
				</form> --}}
			</div>
	<hr>
			<?php } ?>
	</div>
	
@endsection