<?php

namespace App\Business\Exception;

class AuthorNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Author not found');
    }
}
