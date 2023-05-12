@extends('layouts.app')

@section('content')
<div class="flex justify-center">
  <h1 class="text-3xl font-bold mb-4">Edit Post</h1>
</div>
<div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
<form action="{{ route('posts.update', [$forum, $post]) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
        <input type="text" class="form-input rounded-md shadow-sm w-full" id="title" name="title" value="{{ $post->title }}">
    </div>
    <div class="mb-4">
        <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
        <textarea class="form-input rounded-md shadow-sm w-full" id="body" name="body">{{ $post->body }}</textarea>
    </div>
    <div class="mb-4">
        <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
        <div class="mb-3">
            @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="max-w-xs rounded-md shadow-sm">
            @else
            <p>No image uploaded.</p>
            @endif
        </div>
        <div class="flex items-center justify-between mb-3">
            <div class="flex-1 pr-4">
                <div class="relative rounded-md shadow-sm">
                    <input type="file" class="form-input block w-full sm:text-sm sm:leading-5" id="image" name="image">
                    <label class="absolute inset-0 bg-white opacity-50 rounded-md"></label>
                    <label class="absolute top-0 right-0 bg-indigo-500 text-white py-2 px-3 rounded-md hover:bg-indigo-600 cursor-pointer" for="image">Choose file</label>
                </div>
            </div>
            <div class="flex-initial">
                <button class="bg-red-500 text-white py-2 px-3 rounded-md hover:bg-red-600" type="button" id="delete-image-btn">Delete</button>
            </div>
        </div>
        <input type="hidden" name="remove_image" id="remove-image" value="0">
    </div>
    <div class="mb-4">
        <label for="current_image" class="block text-gray-700 font-bold mb-2">Current Image</label>
        <div class="mb-3">
            @if($post->image)
            <img src="{{ asset('storage/images/'.$post->image) }}" alt="{{ $post->title }}" class="max-w-xs rounded-md shadow-sm">
            @else
            <p>No image uploaded.</p>
            @endif
        </div>
    </div>
    <div class="mb-4">
    <label for="tags" class="block text-gray-700 font-bold mb-2">Tags</label>
    <select name="tags[]" id="tags" multiple class="form-multiselect block rounded-md shadow-sm">
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}" @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) selected @endif>{{ $tag->name }}</option>
        @endforeach
    </select>
</div>
    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded-md">Update Post</button>
</form>
</div>
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