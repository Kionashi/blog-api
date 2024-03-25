<?php

namespace App\Data\Entity;

class Author
{
    public function __construct(
        public int $id,
        public string $name,
        public string $username,
        public string $email,
        public string $phone
    ) {
    }
}
