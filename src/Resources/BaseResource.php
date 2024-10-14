<?php

namespace Autoznetwork\Php700Credit\Resources;

use Autoznetwork\Php700Credit\Classes\Consumer;
use Autoznetwork\Php700Credit\Php700Credit as Connector;

abstract class BaseResource
{
    protected ?Consumer $consumer;

    public function __construct(protected Connector $connector)
    {
        $this->consumer = $this->connector->getConsumer();
    }
}
