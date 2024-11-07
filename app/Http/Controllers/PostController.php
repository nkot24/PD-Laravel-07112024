<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()->orderby('created_at','desc')->get();
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at
        ];

        Post::create($data);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show($id,Post $post)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Post $post)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id,Post $post)
    {
        $post = Post::find($id);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at
        ];

        $post->update($data);

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,Post $post)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts');
    }    
}
