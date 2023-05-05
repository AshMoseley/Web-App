@extends('layouts.app')

@section('title', 'Create Forum')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Forum</h1>
                <hr>
                @can('create', $forum)
                    <form method="POST" action="{{ route('forum.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                @else
                    <p>You are not authorized to access this page.</p>
                @endcan
            </div>
        </div>
    </div>
@endsection
