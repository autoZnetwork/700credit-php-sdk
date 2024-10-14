<?php

namespace Autoznetwork\Php700Credit\Requests;

use Autoznetwork\Php700Credit\Classes\Consumer;
use Autoznetwork\Php700Credit\Enums\ProductType;
use Autoznetwork\Php700Credit\Exceptions\ConsumerNotSet;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;

class PreQualifyRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(public ?Consumer $consumer)
    {
        $this->doChecks();
    }

    public function resolveEndpoint(): string
    {
        return '';
    }

    protected function defaultBody(): array
    {
        $address = $this->consumer->address;

        return [
            'PRODUCT' => ProductType::PRE_QUALIFY->value,
            'NAME' => $this->consumer->name,
            'ADDRESS' => $address->street,
            'CITY' => $address->city,
            'STATE' => $address->state,
            'ZIP' => $address->zip,
        ];
    }

    /**
     * @throws ConsumerNotSet
     */
    protected function doChecks(): void
    {
        if (is_null($this->consumer)) {
            throw new ConsumerNotSet;
        }
    }
}
