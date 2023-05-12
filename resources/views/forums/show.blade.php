<style>
  .forum-background {
    background: #222; 
    background-size: cover;
    background-position: center center;
    color: #fff;
    text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
}


    /* .card {
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: #fff;
        border-radius: 0.5rem;
        transition: box-shadow 0.3s ease;
    } */

    .card:hover {
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.2);
    }

    .card:hover {
        border: 1px solid #ccc;
    }
    
</style>

@extends('layouts.app')

@section('content')
<div class="forum-background">
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="md:col-span-2">
                <h1 class="text-4xl font-bold mb-4">{{ $forum->name }}</h1>
                <p class="mb-4">{{ $forum->description }}</p>
                <hr class="my-4">
                @forelse($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="text-2xl font-bold mb-2"><a href="{{ route('posts.show', [$forum, $post]) }}" class="hover:text-blue-700">{{ $post->title }}</a></h2>
                        <p class="mb-2">{{ $post->body }}</p>
                    </div>
                    <div class="card-footer text-muted text-sm">
                        Posted by <a href="{{ route('users.posts', $post->user) }}" class="underline hover:text-blue-700">{{ $post->user->name }}</a> on {{ $post->created_at->toFormattedDateString() }}
                    </div>
                </div>
                @empty
                <p>No posts found</p>
                @endforelse

                {{ $posts->links() }}
            </div>
            <div class="md:col-span-1">
                @auth
                <div class="card mb-3">
                    <div class="card-body">
                        <a href="{{ route('posts.create', $forum) }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full">Create post</a>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection