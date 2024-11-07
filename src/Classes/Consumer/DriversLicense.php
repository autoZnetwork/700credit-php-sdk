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
        $this->expiration = $this->formatExpiration($this->expiration);
    }

    /**
     * @throws Php700CreditRequestException
     */
    protected function formatState(?string $state): ?string
    {
        if (is_string($state) && strlen($state) !== 2) {
            throw new Php700CreditRequestException('State must only be two characters.');
        }

        return $state;
    }

    /**
     * @throws Php700CreditRequestException
     */
    protected function formatExpiration(?string $expiration): ?string
    {
        if (is_null($expiration)) {
            return null;
        }

        $patterns = [
            'MM.DD.YY' => '/^\d{2}\.\d{2}\.\d{2}$/',
            'MM.DD.YYYY' => '/^\d{2}\.\d{2}\.\d{4}$/',
            'MM-DD-YY' => '/^\d{2}-\d{2}-\d{2}$/',
            'MM-DD-YYYY' => '/^\d{2}-\d{2}-\d{4}$/',
            'MM/DD/YY' => '/^\d{2}\/\d{2}\/\d{2}$/',
            'MM/DD/YYYY' => '/^\d{2}\/\d{2}\/\d{4}$/',
        ];

        $patternFound = false;

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $expiration)) {
                $patternFound = true;
                break;
            }
        }

        if (! $patternFound) {
            throw new Php700CreditRequestException(
                'Expiration must match one of the following patterns: '.implode(', ', array_keys($patterns))
            );
        }

        return $expiration;
    }
}
