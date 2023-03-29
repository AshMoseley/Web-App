@extends('layouts.app')

@section('title', 'Forum')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Forums</h1>
                <hr>
                @foreach($forums as $forum)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2><a href="{{ route('forum.show', $forum) }}">{{ $forum->name }}</a></h2>
                            <p>{{ $forum->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection