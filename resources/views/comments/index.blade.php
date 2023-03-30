<!-- resources/views/comments/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Comments</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Post</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->post->title }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>
                        <a href="{{ route('comments.edit', ['comment' => $comment]) }}">Edit</a>
                        <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
