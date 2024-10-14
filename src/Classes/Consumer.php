<?php

namespace Autoznetwork\Php700Credit\Classes;

class Consumer
{
    public ?string $email = null;

    public ?string $ssn = null;

    public ?string $dob = null;

    public ?ConsumerAddress $previousAddress = null;

    public function __construct(public string $name, public ConsumerAddress $address) {}

    public function email(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function ssn(string $ssn): self
    {
        $this->ssn = $ssn;

        return $this;
    }

    public function dob(string $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function previousAddress(ConsumerAddress $address): self
    {
        $this->previousAddress = $address;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'NAME' => $this->name,
            'ADDRESS' => $this->address->street,
            'CITY' => $this->address->city,
            'STATE' => $this->address->state,
            'ZIP' => $this->address->zip,
            'DOB' => $this->dob,
            'EMAIL' => $this->email,
            'PREVADDRESS' => $this->previousAddress?->street,
            'PREVCITY' => $this->previousAddress?->city,
            'PREVSTATE' => $this->previousAddress?->state,
            'PREVZIP' => $this->previousAddress?->zip,
        ]);
    }
}
