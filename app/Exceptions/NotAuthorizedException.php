<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotAuthorizedException extends Exception
{
    public function __construct($message = "Usuário não autorizado.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
