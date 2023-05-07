@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="font-bold text-lg mb-4">{{ __('Edit Forum') }}</div>
        <form class="w-full" role="form" method="POST" action="{{ route('forum.update', $forum) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-input w-full @error('name') border-red-500 @enderror" name="name" value="{{ $forum->name }}" required autofocus>
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">{{ __('Description') }}</label>
                <textarea id="description" class="form-input w-full h-64 resize-none @error('description') border-red-500 @enderror" name="description" required>{{ $forum->description }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection