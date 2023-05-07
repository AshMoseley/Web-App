<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Livecomment extends Component
{
    public $post;
    public $newComment;

    public function render()
    {
        return view('livewire.livecomment', [
            'livecomments' => $this->post->comments()->with('user')->get(),
        ]);
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:5',
        ]);

        $this->post->comments()->create([
            'body' => $this->newComment,
            'user_id' => auth()->id(),
        ]);

        $this->newComment = '';
    }
}
