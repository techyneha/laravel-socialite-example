@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard -- {!! Helper::shout('this is my first helper function') !!}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ url('/posts/create') }}" class="btn btn-primary">Create Post</a>
                    <hr>
                    <h3>Your Blog Post are</h3>
                    @if(count(auth()->user()->posts) > 0)
                    @foreach(auth()->user()->posts as $post)
                    {{-- @dd($post->user) --}}
                    <div class="pdata">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                @if(!empty($post->cover_image))
                                <img style="width: 100%;" src="{{ url('/blog_img/'.$post->cover_image ) }} ">
                                @endif
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <h6>{{ ucwords($post->title) }}</h6>
                                <div class="well">
                                {{-- {!! ucwords($post->body) !!} --}}
                                {!! Helper::shout($post->body) !!}
                                </div>
                                <p>Post added by : {{ ucwords(auth()->user()->name)}}</p>  
                            </div>
                        </div>
                        
                    </div>
                    <div class="fbutton well">
                        <a href="{{ route('posts.edit',['post'=>$post->id]) }}" class="btn btn-info">Edit</a>
                        <form method="POST" action="{{ route('posts.destroy',['post'=>$post->id]) }}">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <hr>
                    @endforeach
                    @else
                    <p>Post not done</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
