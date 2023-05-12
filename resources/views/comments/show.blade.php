@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $post->title }}
                    <div class="float-right">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-primary mr-2">
                            Edit
                        </a>
                        <form class="d-inline" method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <p>{{ $post->body }}</p>
                    <hr>
                    <h4>Comments</h4>
                    <ul class="list-group">
                        @foreach ($post->comments as $comment)
                        <li class="list-group-item">
                            {{ $comment->body }}
                            <div class="float-right">
                                <a href="{{ route('comments.edit', [$post, $comment]) }}" class="btn btn-sm btn-primary mr-2">
                                    Edit
                                </a>
                                <form class="d-inline" method="POST" action="{{ route('comments.destroy', [$post, $comment]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <br>
                            <small class="text-muted">
                                posted by {{ $comment->user->name }} on {{ $comment->created_at->format('Y-m-d') }}
                            </small>
                        </li>
                        @endforeach
                    </ul>
                    <hr>
                    <h4>Add Comment</h4>
                    <form method="POST" action="{{ route('comments.store', $post) }}">
                        @csrf
                        <div class="form-group">
                            <label for="body">Comment:</label>
                            <textarea name="body" id="body" rows="5" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    @if(auth()->user() && auth()->user()->id == $comment->user_id)
                    <a href="{{ route('comments.edit', ['forum' => $forum->slug, 'post' => $post->slug, 'comment' => $comment->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('comments.destroy', ['forum' => $forum->slug, 'post' => $post->slug, 'comment' => $comment->id]) }}" method="post" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection