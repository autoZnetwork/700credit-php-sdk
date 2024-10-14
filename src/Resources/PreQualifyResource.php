<?php

namespace Autoznetwork\Php700Credit\Resources;

use Autoznetwork\Php700Credit\Exceptions\InvalidResponse;
use Autoznetwork\Php700Credit\Requests\PreQualifyRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\XmlWrangler\Exceptions\QueryAlreadyReadException;
use Saloon\XmlWrangler\Exceptions\XmlReaderException;

class PreQualifyResource extends BaseResource
{
    /**
     * @throws \Throwable
     * @throws QueryAlreadyReadException
     * @throws XmlReaderException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws InvalidResponse
     */
    public function get()
    {
        $xmlReader = $this->connector->send(new PreQualifyRequest(
            consumer: $this->consumer,
        ))->xmlReader();

        $report = $xmlReader->value('XML_Report')->first();

        if (is_null($report)) {
            throw new InvalidResponse;
        }

        return $report;
    }
}
