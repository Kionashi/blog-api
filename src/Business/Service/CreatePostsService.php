<?php

namespace App\Business\Service;

use App\Business\Exception\ErrorCreatingPostException;
use App\Data\Entity\Post;
use App\Data\Repository\PostRepository;

class CreatePostsService
{
    public function __construct(public PostRepository $postRepository)
    {
    }

    public function __invoke(int $authorId, string $title, string $body): void
    {
        try {
            $post = new Post(
                id: null,
                authorId: $authorId,
                title: $title,
                body: $body
            );
            $this->postRepository->persist($post);
        } catch (\Exception) {
            throw new ErrorCreatingPostException();
        }
    }
}
