<?php

namespace App\Business\Exception;

class ErrorCreatingPostException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Error creating post');
    }
}
