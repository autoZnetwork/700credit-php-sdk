<?php

namespace Autoznetwork\Php700Credit\Exceptions;

use Saloon\Exceptions\SaloonException;

class CreditSystemError extends SaloonException
{
    public function __construct(public int $systemErrorCode, string $message)
    {
        parent::__construct(message: $message);
    }
}
