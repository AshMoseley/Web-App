<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Forum;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Forum $forum)
    {
        $posts = $forum->posts()->with('user', 'comments')->paginate(10);

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
        $post = new Post([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user()->id
        ]);

        $forum->posts()->save($post);

        return redirect()->route('posts.index', $forum);
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



    public function comment(Request $request, Forum $forum, Post $post)
    {
        $comment = new Comment([
            'body' => $request->body,
            'user_id' => $request->user()->id
        ]);

        $post->comments()->save($comment);

        return redirect()->route('posts.show', [$forum, $post]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', compact('post'));
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
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
    
        return redirect()->route('posts.show', [$forum, $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post->delete();

        return redirect()->route('posts.index', $post->forum);
    }
}
