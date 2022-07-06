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

    public function getPost(int $postId)
    {
        return $this->postRepository->getById($postId);
    }

    public function saveUpdate($postId, array $updateingDetails)
    {
        return $this->postRepository->update($postId, $updateingDetails);
    }

    public function deletePost($postId)
    {
        return $this->postRepository->deleteById($postId);
    }

}
