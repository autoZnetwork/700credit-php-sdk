<?php

namespace Autoznetwork\Php700Credit\Classes;

class Credentials
{
    public function __construct(
        public ?string $account = null,
        public ?string $password = null,
        public ?string $preQualifyAccount = null,
        public ?string $preQualifyPassword = null,
    ) {}

    public function hasAccountCredentials(): bool
    {
        return
            ! is_null($this->account ?: null) &&
            ! is_null($this->password ?: null);
    }

    public function hasPrequalifyCredentials(): bool
    {
        return
            ! is_null($this->preQualifyAccount ?: null) &&
            ! is_null($this->preQualifyPassword ?: null);
    }

    public function hasAllCredentials(): bool
    {
        return $this->hasAccountCredentials() && $this->hasPrequalifyCredentials();
    }
}
