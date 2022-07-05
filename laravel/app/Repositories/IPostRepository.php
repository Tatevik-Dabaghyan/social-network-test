<?php
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface IPostRepository
{
    public function getAll(): Collection;

    public function getById($id): ?Post;

    public function store(array $request): Post;

    public function update($id, array $updateingDetails): Collection;

    public function deleteById($id): int;

    public function getByAuthUserId($authUserId): Collection;
}
