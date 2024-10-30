<?php

namespace Autoznetwork\Php700Credit\Requests;

use Autoznetwork\Php700Credit\Classes\Consumer\Consumer;
use Autoznetwork\Php700Credit\Classes\Credentials;
use Autoznetwork\Php700Credit\Enums\ProductType;
use Autoznetwork\Php700Credit\Traits\RequiresPrequalifyCredentials;

class PreQualifyRequest extends AbstractRequest
{
    use RequiresPrequalifyCredentials;

    protected ProductType $productType = ProductType::PRE_QUALIFY;

    protected array $requiredFields = [
        'NAME',
        'ADDRESS',
        'CITY',
        'STATE',
        'ZIP',
    ];

    public function __construct(
        public Credentials $credentials,
        public ?Consumer $consumer,
    ) {}

    protected function defaultBody(): array
    {
        return array_filter(array_merge([
            'ACCOUNT' => $this->credentials->preQualifyAccount,
            'PASSWD' => $this->credentials->preQualifyPassword,
            'PRODUCT' => ProductType::PRE_QUALIFY->value,
        ], $this->consumer->toArray()));
    }
}
