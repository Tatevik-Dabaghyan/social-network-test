<?php
namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;

//use App\Repositories\IPostRepository;
//use App\Models\Post;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ){}

    public function listAuthPosts(int $authUserId)
    {
        return $this->postRepository->getByAuthUserId($authUserId);
    }

    public function savePost(array $post)
    {
        return $this->postRepository->store($post);
    }

}
