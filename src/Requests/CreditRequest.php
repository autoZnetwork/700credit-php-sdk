<?php

namespace Autoznetwork\Php700Credit\Requests;

use Autoznetwork\Php700Credit\Classes\Consumer\Consumer;
use Autoznetwork\Php700Credit\Classes\Consumer\Cosigner;
use Autoznetwork\Php700Credit\Classes\Credentials;
use Autoznetwork\Php700Credit\Classes\Vehicle\TradeInVehicle;
use Autoznetwork\Php700Credit\Classes\Vehicle\Vehicle;
use Autoznetwork\Php700Credit\Enums\ProductType;
use Autoznetwork\Php700Credit\Traits\RequiresBureau;
use Autoznetwork\Php700Credit\Traits\RequiresCredentials;

class CreditRequest extends AbstractRequest
{
    use RequiresBureau;
    use RequiresCredentials;

    protected ProductType $productType = ProductType::CREDIT;

    protected array $requiredFields = [
        'NAME',
        'SSN',
        'ADDRESS',
        'CITY',
        'STATE',
        'ZIP',
    ];

    public function __construct(
        public Credentials $credentials,
        public ?Consumer $consumer,
        public ?Cosigner $cosigner,
        public ?Vehicle $vehicle,
        public ?TradeInVehicle $tradeInVehicle,
    ) {}

    protected function defaultBody(): array
    {
        return array_filter(array_merge(
            [
                'ACCOUNT' => $this->credentials->account,
                'PASSWD' => $this->credentials->password,
                'PRODUCT' => ProductType::CREDIT->value,
            ],
            $this->consumer->toArray(),
            $this->cosigner?->toArray() ?: [],
            $this->vehicle?->toArray() ?: [],
            $this->tradeInVehicle?->toArray() ?: [],
        ));
    }
}
