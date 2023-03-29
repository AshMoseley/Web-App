@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $forum->name }}</h1>
                <p>{{ $forum->description }}</p>
                <hr>
                @foreach($forum->threads as $thread)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2><a href="{{ route('thread.show', [$forum, $thread]) }}">{{ $thread->title }}</a></h2>
                            <p>{{ $thread->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
