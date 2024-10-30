<?php

namespace Autoznetwork\Php700Credit\Classes\Consumer;

use Autoznetwork\Php700Credit\Exceptions\Php700CreditRequestException;

class DriversLicense
{
    public function __construct(
        public ?string $number = null,
        public ?string $expiration = null,
        public ?string $state = null,
        public ?string $county = null,
    ) {
        $this->format();
    }

    protected function format(): void
    {
        $this->state = $this->formatState($this->state);
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
}
