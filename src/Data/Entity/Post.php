<?php

namespace App\Data\Entity;

class Post
{
    public function __construct(
        public int $authorId,
        public string $title,
        public string $body,
        public ?int $id = null,
    ) {
    }
}
