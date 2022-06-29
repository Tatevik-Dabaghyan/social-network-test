<?php

namespace App\Http\Controllers\Posts;
use App\Http\Controllers\Controller;
use App\Models\Post;

use Illuminate\Http\Request;

class PostsProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUserId = 1;
        $posts = Post::query()->where('user_id', $authUserId)->orderBy('created_at', 'desc')->get();

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $this->validate($request, [
            'text' => 'required'
        ]); */
        $authUserId = 1;

        $post = new Post();
        $post->user_id = $authUserId;
        $post->text = $request->input('text');
        $post->save();

        return redirect()->to('/profile')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* $this->validate($request, [
            'text' => 'required'
        ]); */

        $post = Post::find($id);
        $post->text = $request->input('text');
        $post->save();

        return redirect()->to('/profile')->with('success', 'Post edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->to('/profile')->with('success', 'Post deleted successfully.');
    }
}
