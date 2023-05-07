<div>
@foreach($livecomments->sortBy('created_at') as $comment)
        <div class="bg-gray-200 p-4 mb-4">
            <p class="text-lg">{{ __('Comment by') }} <a href="{{ route('users.posts', $comment->user) }}" class="text-blue-500 hover:underline">{{ $comment->user->name }}</a> {{ __('on') }} {{ $comment->created_at->format('M d, Y') }}</p>
            <p class="text-lg">{{ $comment->body }}</p>
            @can('delete', $comment)
                <div class="btn-group">
                    @can('update', $comment)
                        <a href="{{ route('comments.edit',['forum' => $post->forum->id, 'post' => $post->id, 'comment' => $comment->id]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                    @endcan
                    <button type="button" class="btn btn-sm btn-danger delete-comment" data-toggle="modal" data-target="#delete-comment-modal" data-id="{{ $comment->id }}">{{ __('Delete') }}</button>
                </div>
            @endcan
        </div>
    @endforeach

    <div class="mt-4">
        <form wire:submit.prevent="addComment">
            <div class="form-group">
                <label for="body">{{ __('Add a comment') }}</label>
                <textarea wire:model.lazy="newComment" name="body" id="body" class="form-control{{ $errors->has('newComment') ? ' is-invalid' : '' }}" rows="5" required>{{ old('newComment') }}</textarea>
                @if ($errors->has('newComment'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('newComment') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Add Comment') }}</button>
        </form>
    </div>

    <div wire:loading>
        {{ __('Adding comment...') }}
    </div>
</div>
