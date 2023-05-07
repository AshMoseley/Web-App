<!-- home.blade.php -->
@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-2">Welcome to the Forum</h1>
            <p>This is the home page of the forum.</p>
            <p>Please register or log in to participate.</p>
        </div>
        <div class="mt-12 flex justify-center">
            <div class="w-full lg:w-3/4 rounded-lg overflow-hidden shadow-lg">
                <div class="bg-blue-500 px-8 py-6 rounded-t-lg">
                    <div class="grid grid-cols-3">
                        <div class="bg-white rounded-lg p-4 text-center px-6 py-8 mr-6">
                            <h2 class="text-lg font-bold">Create any post you like</h2>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center px-6 py-8 mr-6">
                            <h2 class="text-lg font-bold">Connect with others</h2>

                        </div>
                        <div class="bg-white rounded-lg p-4 text-center px-6 py-8 mr-6">
                            <h2 class="text-lg font-bold">Enjoy your stay</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection