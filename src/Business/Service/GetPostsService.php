<?php

namespace App\Business\Service;

use App\Business\Dto\GetPostsOutDto;
use App\Business\Exception\InvalidPostResponseException;
use App\Data\Repository\PostRepository;

class GetPostsService
{
    public function __construct(public PostRepository $postRepository)
    {
    }

    public function __invoke(): GetPostsOutDto
    {
        try {
            $posts = $this->postRepository->findAll();
            $total = count($posts);
            $getPostOutDto = new GetPostsOutDto(
                posts: $posts,
                total: $total
            );

            return $getPostOutDto;
        } catch (\Exception) {
            throw new InvalidPostResponseException();
        }
    }
}
