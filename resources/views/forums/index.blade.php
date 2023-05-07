@extends('layouts.app')

@section('title', 'Forum')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-6">Forums</h1>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($forums as $forum)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <a href="{{ route('forum.show', $forum) }}">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold">{{ $forum->name }}</h2>
                            <p class="text-gray-600 mt-2">{{ $forum->description }}</p>
                            @can('update', $forum)
                                <a href="{{ route('forum.edit', $forum) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full mt-4">Edit</a>
                            @endcan
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @can('create', $forum)
            <div class="mt-6">
                <a href="{{ route('forum.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full">Create Forum</a>
            </div>
        @endcan
    </div>
@endsection
