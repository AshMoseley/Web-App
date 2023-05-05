<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Forum;
use App\Models\Post;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->with(['comments', 'tags'])->latest()->paginate(10);

        return view('tags.show', compact('tag', 'posts'));
    }

    public function create($forumId)
    {
        $forum = Forum::findOrFail($forumId);
        $tags = Tag::all();
    
        return view('posts.create', compact('forum', 'tags'));
    }
}
