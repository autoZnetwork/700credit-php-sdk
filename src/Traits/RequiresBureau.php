<?php

namespace Autoznetwork\Php700Credit\Traits;

use Autoznetwork\Php700Credit\Exceptions\BureauRequired;
use Saloon\Http\PendingRequest;

trait RequiresBureau
{
    /**
     * @throws BureauRequired
     */
    public function bootRequiresBureau(PendingRequest $pendingRequest): void
    {
        $bureaus = $pendingRequest->getConnector()->getBureaus();

        if (count($bureaus) === 0) {
            throw new BureauRequired(sprintf(
                'At least one bureau is required when doing a %s request.',
                $pendingRequest->getRequest()->productType->value,
            ));
        }
    }
}
