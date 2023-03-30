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
                                @if(auth()->user()->id == $comment->user_id)
                                <div class="btn-group">
                                    <a href="{{ route('comments.edit', ['forum' => $post->forum->id, 'post' => $post->id, 'comment' => $comment->id]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <form method="POST" action="{{ route('comments.destroy', ['forum' => $post->forum->id, 'post' => $post->id, 'comment' => $comment->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <h4>{{ __('Add a Comment') }}</h4>
                    <form method="POST" action="{{ route('comments.store', ['forum' => $post->forum->id, 'post' => $post->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="body">{{ __('Comment') }}</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




