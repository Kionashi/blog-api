<?php

namespace App\Api\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CreatePostsRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public string $title,

        #[Assert\NotBlank]
        public string $body,

        #[Assert\Positive(
            message: 'The authorId {{ value }} must be a positive number greater than zero.',
        )]
        public int $authorId,
    ) {
    }
}
