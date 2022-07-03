<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Post;
use App\Models\Media_Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUserId = 1;

        $posts = DB::table('posts')
            ->leftJoin('media_post', 'posts.id', '=', 'media_post.post_id')
            ->leftJoin('media', 'media.id', '=', 'media_post.media_id')
            ->select('posts.*', 'media.source', 'media.type')
            ->where('posts.user_id', $authUserId)->orderBy('posts.created_at', 'desc')->get();

        //dd($posts);
        //$posts = Post::query()->where('user_id', $authUserId)->orderBy('created_at', 'desc')->get();

        return view('profile.index',[
            'posts' => $posts,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        //uploading files
        $media = new Media();

        $filenameWithExtention = $request->file('media')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
        $fileExtention = $request->file('media')->getClientOriginalExtension();
        $fileMimeType = $request->file('media')->getMimeType();
        $fileType = explode('/', $fileMimeType)[0];

        //dd($request->media);
        //dd($filenameWithExtention, $filename, $fileExtention, $fileMimeType, $fileType);

        $filenameToStore = time() . '.' . $fileExtention;
        $request->media->storeAs('public/media', $filenameToStore);

        $media->user_id = $authUserId;
        $media->source = $filenameToStore;
        $media->type = $fileType;
        $media->mime_type = $fileMimeType;
        $media->save();

        //insert relational data into media_post table

        //todo:must be refactored. many to many rel.

        $mediaPost = new Media_Post();
        $mediaPost->media_id = $media->id;
        $mediaPost->post_id = $post->id;
        $mediaPost->save();

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

        $authUserId = 1;
        $posts = Post::query()->where('user_id', $authUserId)->orderBy('created_at', 'desc')->get();

        return view('profile.index', [
            'post' => $post,
            'posts' => $posts,
        ]);
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
