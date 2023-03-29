@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $forum->name }}</h1>
                <p>{{ $forum->description }}</p>
                <hr>
                @foreach($forum->posts as $posts)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2><a href="{{ route('post.show', [$forum, $post]) }}">{{ $post->title }}</a></h2>
                            <p>{{ $post->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
