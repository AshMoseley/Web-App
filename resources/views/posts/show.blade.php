<style>
  .post-background {
    background: #222; 
    background-size: cover;
    background-position: center center;
    color: #fff;
    text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
}

</style>


@extends('layouts.app')

@section('content')

    <div class="bg-primary">
        <div class="container py-4">
            <div class="max-w-4xl mx-auto">
            <div class="bg-black p-6 rounded-lg shadow-lg max-w-1xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-1xl mx-auto">
                        <h1 class="text-2xl font-semibold">{{ $post->title }}</h1>
                        <div class="text-gray-600">{{ __('By') }} {{ $post->user->name }}</div>
                    <div class="card-body">
                        <p class="text-lg">{{ $post->body }}</p>
                        @if($post->image)
                        <img src="{{ asset('storage/images/'.$post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                        @endif
                        <h5 class="card-title">{{ __('Tags') }}</h5>
                        <ul class="list-inline">
                            @foreach ($post->tags as $tag)
                            <li class="list-inline-item"><a href="{{ route('tags.show', $tag) }}" class="px-2 py-1 bg-gray-200 rounded-lg">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="bg-gray-200 py-3">
                        @can('delete', $post)
                        <div class="float-right">
                            <form action="{{ route('posts.destroy', ['forum' => $post->forum->id, 'post' => $post->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="bg-red-500 text-white py-2 px-3 rounded-md hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this post?')">{{ __('Delete') }}</button>
                            </form>
                            @can('update', $post)
                            <a href="{{ route('posts.edit', ['forum' => $post->forum->id, 'post' => $post->id]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full mt-4">{{ __('Edit') }}</a>
                            @endcan
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-1xl mx-auto">
                    <livewire:livecomment :post="$post" />
                </div>
</div>
            </div>
        </div>
</div>
    </div>
@endsection