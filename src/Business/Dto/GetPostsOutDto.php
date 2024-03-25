<?php

namespace App\Business\Dto;

use App\Data\Entity\Post;

readonly class GetPostsOutDto
{
    /** @param array<Post> $posts */
    public function __construct(
        public array $posts,
        public int $total,
    ) {
    }
}
