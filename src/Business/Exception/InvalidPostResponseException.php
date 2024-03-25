<?php

namespace App\Business\Exception;

class InvalidPostResponseException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Error fetching posts from datasource');
    }
}
