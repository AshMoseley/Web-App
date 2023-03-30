@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>
                <div class="card-body">
                    <p>{{ $post->body }}</p>
                    <hr>
                    <h3>{{ __('Comments') }}</h3>
                    @foreach($post->comments as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                <p>{{ $comment->body }}</p>
                                <p class="card-subtitle text-muted">{{ __('Commented by') }} {{ $comment->user->name }} {{ __('on') }} {{ $comment->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
