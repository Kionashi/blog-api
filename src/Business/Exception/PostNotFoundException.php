<?php

namespace App\Business\Exception;

class PostNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Post not found');
    }
}
