<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Forum;
use App\Models\Comment;
use App\Models\Role;
use App\Policies\PostPolicy;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Forum $forum)
    {
        $this->authorize('view', $forum);

        $posts = Post::where('forum_id', $forum->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($posts as $post) {
            $this->setPostAttributes($post);
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
        $this->authorize('create', Post::class);

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

         // Handle image upload
         if ($request->has('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $post->image = basename($imagePath);
            $post->save();
        }
        
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

        $this->authorize('view', $post);

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
        $this->authorize('update', $post);

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
    $this->authorize('update', $post);

    $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'remove_image' => 'nullable|boolean'
    ]);

    $post->title = $request->input('title');
    $post->body = $request->input('body');

    if ($request->hasFile('image')) {
        if ($post->image && file_exists(public_path('images/' . $post->image))) {
            unlink(public_path('images/' . $post->image));
        }
    
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');
        $post->image = $imageName;
    } else if ($request->input('remove_image') == 1) {
        if ($post->image && file_exists(public_path('images/' . $post->image))) {
            unlink(public_path('images/' . $post->image));
        }
    
        $post->image = null;
    }
    
    $post->save();

    return redirect()->route('posts.show', ['forum' => $forum->id, 'post' => $post->id])
        ->with('success', 'Post updated successfully.');
}

    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Forum $forum, Post $post)
    {      
        $this->authorize('delete', $post);

        
         $post->delete();

         return redirect()->route('forum.show', ['forum' => $forum->id])
         ->with('success', 'Post deleted successfully.');
    }
}
