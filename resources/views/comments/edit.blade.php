@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Comment') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.updateComment', [$post, $comment]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="body">{{ __('Comment') }}</label>
                                <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" rows="5" required>{{ $comment->body }}</textarea>

                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Comment') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
