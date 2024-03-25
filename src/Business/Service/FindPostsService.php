<?php

namespace App\Business\Service;

use App\Business\Dto\FindPostsOutDto;
use App\Business\Exception\InvalidAuthorResponseException;
use App\Business\Exception\InvalidPostResponseException;
use App\Business\Exception\PostNotFoundException;
use App\Data\Repository\AuthorRepository;
use App\Data\Repository\PostRepository;

class FindPostsService
{
    public function __construct(
        public PostRepository $postRepository,
        public AuthorRepository $authorRepository,
    ) {
    }

    public function __invoke(int $postId): FindPostsOutDto
    {
        try {
            $post = $this->postRepository->findById($postId);
        } catch (\Exception) {
            throw new InvalidPostResponseException();
        }

        if (null === $post) {
            throw new PostNotFoundException();
        }

        try {
            $author = $this->authorRepository->findById($post->authorId);
        } catch (\Exception) {
            throw new InvalidAuthorResponseException();
        }

        $findPostOutDto = new FindPostsOutDto(
            id: $post->id,
            title: $post->title,
            body: $post->body,
            author: $author
        );

        return $findPostOutDto;
    }
}
