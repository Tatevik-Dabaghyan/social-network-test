<?php
namespace App\Repositories;

use App\Models\Post;
use App\Repositories\IPostRepository;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements IPostRepository
{
    public function __construct(
        private Post $post
    ){}

    public function getAll(): Collection
    {
        return $this->post->all();
    }

    public function getById($id): ?Post
    {
        return $this->post->find($id);
    }

    public function store(array $request): Post
    {
        return $this->post->create($request);
    }

    public function update($id, array $updateingDetails): Collection
    {
        return $this->post->whereId($id)->update($updateingDetails);
    }

    public function deleteById($id): int
    {
        return $this->post->destroy($id);
    }

    public function getByAuthUserId($authUserId): Collection
    {
        return $this->post->where('user_id', $authUserId)->get();
    }

}
