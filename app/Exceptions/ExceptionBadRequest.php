<?php

namespace App\Exceptions;

use Exception;

class ExceptionBadRequest extends Exception
{
    //
    protected $message = 'Bad request';
    protected $code = 400;
}
