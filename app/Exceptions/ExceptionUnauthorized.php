<?php

namespace App\Exceptions;

use Exception;

class ExceptionUnauthorized extends Exception
{
    protected $message = 'Unauthorized';
    protected $code = 401;
}
