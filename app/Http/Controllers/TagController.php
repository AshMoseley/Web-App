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

    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(Request $request, Forum $forum)
    {
        $this->authorize('create', Post::class);

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = $forum->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        // Add tags to the post
        $tags = $request->input('tags');
        if ($tags) {
            $tagIds = collect($tags)->map(function ($tag) {
                return Tag::firstOrCreate(['name' => $tag])->id;
            });

            $post->tags()->sync($tagIds);
        }

        return redirect()->route('posts.show', [$forum, $post])->with('success', 'Post created successfully.');
    }
}
