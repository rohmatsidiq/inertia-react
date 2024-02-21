<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //get all posts
        $posts = Post::latest()->get();

        //return view
        return inertia('Posts/Index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return inertia('Posts/Create');
    }

    public function store(Request $request)
    {
        //set validation
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        //create post
        Post::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //redirect
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Disimpan!');
    }

    public function edit(Post $post)
    {
        return inertia('Posts/Edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        //set validation
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        //update post
        $post->update([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //redirect
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(Post $post)
    {
        //delete post
        $post->delete();

        //redirect
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
