<?php

namespace App\Business\Dto;

use App\Data\Entity\Author;

readonly class FindPostsOutDto
{
    public function __construct(
        public int $id,
        public string $title,
        public string $body,
        public Author $author,
    ) {
    }
}
