@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg max-w-xl mx-auto">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Comment') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('comments.update', ['forum' => $post->forum->id, 'post' => $post->id, 'comment' => $comment->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="body" class="block text-gray-700 font-bold mb-2">{{ __('Comment') }}</label>
                            <textarea id="body" class="form-textarea w-full @error('body') border-red-500 @enderror" name="body" rows="5" required>{{ $comment->body }}</textarea>

                            @error('body')
                            <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update Comment') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection