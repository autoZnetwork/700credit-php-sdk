<?php

namespace Autoznetwork\Php700Credit\Classes;

use Autoznetwork\Php700Credit\Exceptions\Php700CreditRequestException;

class ConsumerAddress
{
    public string $street;

    public string $city;

    public string $state;

    public string $zip;

    public function __construct(
        string $address,
        string $city,
        string $state,
        string|int $zip,
    ) {
        $this->formatAddress($address, $city, $state, $zip);
    }

    public function formatAddress(
        string $street,
        string $city,
        string $state,
        string|int $zip,
    ): self {
        $this->street = $street;
        $this->city = $city;
        $this->state = $this->formatState($state);
        $this->zip = $this->formatZip($zip);

        return $this;
    }

    /**
     * @throws Php700CreditRequestException
     */
    protected function formatState(string $state): string
    {
        if (strlen($state) !== 2) {
            throw new Php700CreditRequestException('State must only be two characters.');
        }

        return $state;
    }

    /**
     * Remove alpha characters and only take the first five characters.
     */
    protected function formatZip(string|int $zip): string
    {
        $zip = preg_replace('/[^0-9]/', '', (string) $zip);

        return substr($zip, 0, 5);
    }
}
