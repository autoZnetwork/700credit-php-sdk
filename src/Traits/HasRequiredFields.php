<?php

namespace Autoznetwork\Php700Credit\Traits;

use Autoznetwork\Php700Credit\Exceptions\ConsumerNotSet;
use Autoznetwork\Php700Credit\Exceptions\MissingRequiredFields;
use Saloon\Http\PendingRequest;

trait HasRequiredFields
{
    /**
     * @throws ConsumerNotSet
     * @throws MissingRequiredFields
     */
    public function bootHasRequiredFields(PendingRequest $pendingRequest): void
    {
        if (is_null($pendingRequest->getRequest()->consumer)) {
            throw new ConsumerNotSet;
        }

        $req = $pendingRequest->getRequest();

        if (count($req->requiredFields) > 0) {
            $body = $req->defaultBody();
            $missingFieldsArr = [];

            foreach ($req->requiredFields as $field) {
                $value = $body[$field] ?? null;

                if (is_null($value)) {
                    $missingFieldsArr[] = $field;
                }
            }

            if (count($missingFieldsArr) > 0) {
                throw new MissingRequiredFields(
                    sprintf(
                        'The following required fields are missing: %s.',
                        implode(', ', $missingFieldsArr)
                    )
                );
            }
        }
    }
}
