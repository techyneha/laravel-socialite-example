@extends('layouts.app')
@section('content')
    <h1>{{ $title }}</h1>
    @if(count($contant) > 0)
	    @foreach($contant  as $c)
		    <ul clas="list-group">
		    	<li class= "list-group-items">{{ $c }}</li>
		    </ul>
	    @endforeach
    @endif
@endsection
