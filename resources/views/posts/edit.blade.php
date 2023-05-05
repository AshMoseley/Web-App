@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', [$forum, $post]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" name="body">{{ $post->body }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <div class="mb-3">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="max-width: 300px;">
                @else
                    <p>No image uploaded.</p>
                @endif
            </div>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-outline-danger" type="button" id="delete-image-btn">Delete</button>
                </div>
            </div>
            <input type="hidden" name="remove_image" id="remove-image" value="0">
        </div>
        <div class="form-group">
            <label for="current_image">Current Image</label>
            <div class="mb-3">
                @if($post->image)
                   <img src="{{ asset('storage/images/'.$post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                @else
                    <p>No image uploaded.</p>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('delete-image-btn').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this image?')) {
                document.getElementById('image').value = null;
                this.closest('.input-group').style.display = 'none';
                document.getElementById('remove-image').value = 1;
            }
        });
    </script>
@endsection
