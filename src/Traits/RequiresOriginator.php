<?php

namespace Autoznetwork\Php700Credit\Traits;

use Saloon\Exceptions\MissingAuthenticatorException;
use Saloon\Http\PendingRequest;

trait RequiresOriginator
{
    /**
     * Throw an exception if there was no entity id while it is booting.
     *
     * @throws MissingAuthenticatorException
     */
    public function bootRequiresEntityId(PendingRequest $pendingRequest): void
    {
        if (
            ! $pendingRequest->headers()->get('X-AutozNetwork-Organization-Id') &&
            ! $pendingRequest->headers()->get('X-AutozNetwork-Enterprise-Id')
        ) {
            throw new MissingAuthenticatorException($this->getRequiresEntityId($pendingRequest));
        }
    }

    /**
     * Default message.
     */
    protected function getRequiresEntityId(PendingRequest $request): string
    {
        return sprintf(
            'The "%s" request requires an entity ID. Please provide an organization or enterprise ID using the `withOrganization` or `withEntity` method.',
            $request::class,
        );
    }
}
