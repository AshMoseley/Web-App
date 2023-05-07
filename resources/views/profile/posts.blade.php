@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Posts by {{ $user->name }}</h1>

    @if (count($posts) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white rounded-md overflow-hidden shadow-md">
                    <div class="px-6 py-4">
                        <h2 class="text-xl font-semibold mb-2"><a class="text-blue-500 hover:underline" href="{{ route('posts.show', [$post->forum, $post]) }}">{{ $post->title }}</a></h2>
                        <p class="text-gray-600">{{ $post->body }}</p>
                    </div>
                    <div class="px-6 pt-4 pb-2 bg-gray-100">
                        <p class="text-gray-600">Posted on {{ $post->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="text-3xl font-bold my-6">Comments by {{ $user->name }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($comments as $comment)
                <div class="bg-white rounded-md overflow-hidden shadow-md">
                    <div class="px-6 py-4">
                        <p class="text-gray-600">{{ $comment->body }}</p>
                        <p class="text-gray-600 mt-2">Commented on "<a class="text-blue-500 hover:underline" href="{{ route('posts.show', [$comment->post->forum, $comment->post]) }}">{{ $comment->post->title }}</a>"</p>
                    </div>
                    <div class="px-6 pt-4 pb-2 bg-gray-100">
                        <p class="text-gray-600">Posted on {{ $comment->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No posts found.</p>
    @endif
@endsection
