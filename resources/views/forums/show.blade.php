@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ $forum->name }}</h1>
                <p>{{ $forum->description }}</p>
                <hr>
                @foreach($forum->posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2><a href="{{ route('posts.show', [$forum, $post]) }}">{{ $post->title }}</a></h2>
                            <p>{{ $post->body }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            Posted by {{ $post->user->name }} on {{ $post->created_at->toFormattedDateString() }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                @auth
                    <div class="card mb-3">
                        <div class="card-body">
                          <a href="{{ route('posts.create', $forum) }}" class="btn btn-primary btn-block">Create post</a> 
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
