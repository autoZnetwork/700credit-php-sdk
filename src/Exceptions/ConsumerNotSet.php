<?php

namespace Autoznetwork\Php700Credit\Exceptions;

use Saloon\Exceptions\SaloonException;

class ConsumerNotSet extends SaloonException
{
    protected $message = 'Consumer has not been set.';
}
