<?php

namespace App\Data\Repository;

use App\Data\Entity\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): ?Post;

    /** @return array<Post> */
    public function findAll(): array;

    public function persist(Post $post): void;
}
