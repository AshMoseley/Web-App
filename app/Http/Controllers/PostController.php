<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Forum;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Forum $forum)
    {
        $posts = Post::where('forum_id', $forum->id)
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        foreach ($posts as $post) {
        $post->creatorName = $post->user->name;
        $post->createdAt = $post->created_at->format('M d, Y');
        }

        return view('posts.index', compact('forum', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Forum $forum)
    {
        return view('posts.create', compact('forum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Forum $forum)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
    
        $post = $forum->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', [$forum, $post])->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Forum $forum, Post $post)
    {
        $post->load('user', 'comments.user');

        return view('posts.show', compact('forum', 'post'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Forum $forum, Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post');
        }

        return view('posts.edit', compact('forum', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum, Post $post)
    {
          // Check if the authenticated user is the owner of the post
          if(auth()->user()->id !== $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post');
         }

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.show', [$forum, $post])->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Forum $forum, Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index', $post->forum);
    }
}
