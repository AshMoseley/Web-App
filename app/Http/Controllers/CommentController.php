<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Forum;
use App\Policies\CommentPolicy;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $comments = $post->comments()->get();
        return view('comments.index', compact('comments', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        return view('comments.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Forum $forum, Post $post)
    {
        // Ensure the post belongs to the forum
        if ($post->forum_id != $forum->id) {
            abort(404);
        }
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        $validatedData = $request->validate([
            'body' => 'required|string',
        ]);
    
        $this->authorize('create', [Comment::class, $post]);

        $comment = new Comment;
        $comment->body = $validatedData['body'];
        $comment->user_id = auth()->user()->id;
        $post->comments()->save($comment);
    
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load(['user', 'forum', 'comments.user']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum, Post $post, Comment $comment)
    {
        // Ensure the comment belongs to the post
        if ($comment->post_id != $post->id) {
            abort(404);
        }
    
        $this->authorize('update', $comment);
        
        return view('comments.edit', compact('forum', 'post', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);
        
        // Ensure the comment belongs to the post
        if ($comment->post_id != $post->id) {
            abort(404);
        }
    
        $validatedData = $request->validate([
            'body' => 'required|string',
        ]);
    
        $comment->body = $validatedData['body'];
        $comment->save();
    
        return redirect()->route('posts.show', ['forum' => $forum->id, 'post' => $post->id])->with('success', 'Comment updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum, Post $post, Comment $comment)
    {

         // Ensure the comment belongs to the post
        if ($comment->post_id != $post->id) {
        abort(404);
        }

        $this->authorize('delete', $comment);
        
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
