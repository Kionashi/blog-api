<?php

namespace App\Business\Exception;

class InvalidAuthorResponseException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Error fetching authors from datasource');
    }
}
