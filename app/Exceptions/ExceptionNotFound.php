<?php

namespace App\Exceptions;

use Exception;

class ExceptionNotFound extends Exception
{
    protected $message = 'Not found';
    protected $code = 404;
}
