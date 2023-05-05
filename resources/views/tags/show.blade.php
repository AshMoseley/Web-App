@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Posts tagged with :tag', ['tag' => $tag->name]) }}</h1>
        <hr>
        <div class="row">
            <div class="col-md-8">
                @forelse ($tag->posts as $post)
                    <div class="card mb-3">
                        <div class="card-header">{{ $post->title }}</div>
                        <div class="card-body">
                            <p>{{ $post->body }}</p>
                            @if($post->image)
                                <img src="{{ asset('storage/images/'.$post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                            @endif
                            <ul class="list-inline">
                                @foreach ($post->tags as $tag)
                                    <li class="list-inline-item">{{ $tag->name }}</li>
                                @endforeach
                            </ul>
                            <p class="card-subtitle text-muted">{{ __('Posted by') }} <a href="{{ route('users.posts', $post->user) }}">{{ $post->user->name }}</a> {{ __('on') }} {{ $post->created_at->format('M d, Y') }}</p>
                            <a href="{{ route('posts.show', ['forum' => $post->forum->id, 'post' => $post->id]) }}" class="btn btn-primary">{{ __('View') }}</a>
                        </div>
                    </div>
                @empty
                    <p>{{ __('No posts found.') }}</p>
                @endforelse
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Tags') }}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($tags as $tag)
                                <li class="list-group-item {{ $tag->id === $tag->id ? 'active' : '' }}">
                                    <a href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
                                    <span class="badge badge-secondary">{{ $tag->posts_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
