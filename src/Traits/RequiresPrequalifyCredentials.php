<?php

namespace Autoznetwork\Php700Credit\Traits;

use Autoznetwork\Php700Credit\Classes\Credentials;
use Autoznetwork\Php700Credit\Exceptions\MissingPrequalificationCredentials;
use Saloon\Http\PendingRequest;

trait RequiresPrequalifyCredentials
{
    /**
     * @throws MissingPrequalificationCredentials
     */
    public function bootRequiresPrequalifyCredentials(PendingRequest $pendingRequest): void
    {
        /** @var Credentials|null $credentials */
        $credentials = $pendingRequest->getRequest()->credentials;

        if (is_null($credentials) || ! $credentials->hasAccountCredentials()) {
            throw new MissingPrequalificationCredentials;
        }
    }
}
