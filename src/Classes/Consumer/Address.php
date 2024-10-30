<?php

namespace Autoznetwork\Php700Credit\Classes\Consumer;

use Autoznetwork\Php700Credit\Exceptions\Php700CreditRequestException;

class Address
{
    public function __construct(
        public string $street,
        public string $city,
        public string $state,
        public string|int $zip,
        public ?int $timeAtAddress = null,
    ) {
        $this->format();
    }

    protected function format(): void
    {
        $this->state = $this->formatState($this->state);
        $this->zip = $this->formatZip($this->zip);
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
