<?php

namespace Autoznetwork\Php700Credit\Traits;

use Autoznetwork\Php700Credit\Classes\Credentials;
use Autoznetwork\Php700Credit\Exceptions\MissingCredentials;
use Saloon\Http\PendingRequest;

trait RequiresCredentials
{
    /**
     * @throws MissingCredentials
     */
    public function bootRequiresCredentials(PendingRequest $pendingRequest): void
    {
        /** @var Credentials|null $credentials */
        $credentials = $pendingRequest->getRequest()->credentials;

        if (is_null($credentials) || ! $credentials->hasAccountCredentials()) {
            throw new MissingCredentials;
        }
    }
}
