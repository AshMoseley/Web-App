@extends('layouts.app')

@section('content')
    <h1>{{ $forum->name }}</h1>
    <p>{{ $forum->description }}</p>

    <a href="{{ route('posts.create', $forum) }}" class="btn btn-primary mb-3">Create Post</a>

    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->body }}</p>
                <a href="{{ route('posts.show', [$forum, $post]) }}" class="btn btn-primary">View Post</a>
            </div>
            <div class="card-footer text-muted">
                Posted by <a href="{{ route('user.posts', $post->user) }}">{{ $post->user->name }}</a> on {{ $post->created_at->toFormattedDateString() }}
            </div>
            <div class="card-footer text-muted">
                Comments: {{ $post->comments_count }}
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection
