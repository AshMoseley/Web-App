@extends('layouts.app')

@section('content')
    <h1>Posts by {{ $user->name }}</h1>

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('posts.show', [$post->forum, $post]) }}">{{ $post->title }}</a></h5>
                    <p class="card-text">{{ $post->body }}</p>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $post->created_at->toFormattedDateString() }}
                </div>
            </div>
        @endforeach
        <h2>Comments by {{ $user->name }}</h2>
        @foreach ($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $comment->body }}</p>
                    <p class="card-subtitle text-muted">Commented on "<a href="{{ route('posts.show', [$comment->post->forum, $comment->post]) }}">{{ $comment->post->title }}</a>"</p>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $comment->created_at->toFormattedDateString() }}
                </div>
            </div>
        @endforeach  
    @else
        <p>No posts found.</p>
    @endif
@endsection
