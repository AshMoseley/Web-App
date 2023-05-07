@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="font-bold text-lg mb-4">{{ __('Create a new post in') }} {{$forum->name}}</div>
        <form class="w-full" role="form" method="POST" action="{{ route('posts.store', ['forum' => $forum->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">{{ __('Title') }}</label>
                <input id="title" type="text" class="form-input w-full @error('title') border-red-500 @enderror" name="title" value="{{ old('title') }}" required autofocus>
                @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="body" class="block text-gray-700 font-bold mb-2">{{ __('Body') }}</label>
                <textarea id="body" class="form-input w-full h-64 resize-none @error('body') border-red-500 @enderror" name="body" required>{{ old('body') }}</textarea>
                @error('body')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">{{ __('Image') }}</label>
                <input id="image" type="file" class="form-input w-full @error('image') border-red-500 @enderror" name="image">
                @error('image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Post') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- @if(isset($tags))
                                <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                    <label for="tags" class="col-md-4 control-label">Tags</label>

                                    <div class="col-md-6">
                                        <select id="tags" class="form-control" name="tags[]" multiple>
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('tags'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tags') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
 -->

