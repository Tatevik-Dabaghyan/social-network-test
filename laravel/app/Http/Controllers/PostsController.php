<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Post;
use App\Services\PostService;
use App\Helpers\MediaFile;

use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct(
        private PostService $postService,
        private int         $authUserId = 1
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->listAuthPosts($this->authUserId);

        return view('profile.index', [
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todo: validate Request data

        $post = $this->postService->savePost
        (
            [
                'user_id' => $this->authUserId,
                'text' => $request->input('text'),
            ]
        );

        //uploading files
        $mediaFile = new MediaFile($request);

        //Storage::disk('local')->putFileAs('public', $request->file('media'), $mediaFile->filenameToStore);
        $request->media->storeAs('public/media', $mediaFile->filenameToStore);

        $media = Media::create(
            [
                'user_id' => $this->authUserId,
                'source' => $mediaFile->filenameToStore,
                'type' => $mediaFile->fileType,
                'mime_type' => $mediaFile->fileMimeType,
            ]
        );

        //insert relational data into media_post table
        $post->media()->attach($media->id);

        return redirect()->to('/profile')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $post = $this->postService->getPost($id);
        $posts = $this->postService->listAuthPosts($this->authUserId);

        return view('profile.index', [
            'post' => $post,
            'posts' => $posts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //todo: validate Request data
        /* $this->validate($request, [
            'text' => 'required'
        ]); */

        $this->postService->saveUpdate($id,
            [
                'text' => $request->input('text'),
            ]
        );

        return redirect()->to('/profile')->with('success', 'Post edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id);

        return redirect()->to('/profile')->with('success', 'Post deleted successfully.');
    }
}
