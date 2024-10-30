<?php

namespace Autoznetwork\Php700Credit\Classes\Consumer;

use Autoznetwork\Php700Credit\Enums\HousingType;
use Autoznetwork\Php700Credit\Traits\Conditionable;

class Consumer
{
    use Conditionable;

    public function __construct(
        protected string $name,
        protected ?string $email = null,
        protected ?string $phone = null,
        protected ?string $ssn = null,
        protected ?string $dob = null,
        protected ?HousingType $housingType = null,
        protected ?int $housingPayment = null,
        protected ?Address $address = null,
        protected ?Address $previousAddress = null,
        protected ?Employer $employer = null,
        protected ?Employer $previousEmployer = null,
        protected ?DriversLicense $driversLicense = null,
    ) {
        if (! is_null($this->phone)) {
            $this->phone = $this->formatPhone($phone);
        }
    }

    public function email(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function phone(string $phone): static
    {
        $this->phone = $this->formatPhone($phone);

        return $this;
    }

    public function ssn(string $ssn): static
    {
        $this->ssn = $ssn;

        return $this;
    }

    public function dob(string $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function housingType(HousingType $housingType): static
    {
        $this->housingType = $housingType;

        return $this;
    }

    public function housingPayment(int $housingPayment): static
    {
        $this->housingPayment = $housingPayment;

        return $this;
    }

    public function address(Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function previousAddress(Address $address): static
    {
        $this->previousAddress = $address;

        return $this;
    }

    public function employer(Employer $employer): static
    {
        $this->employer = $employer;

        return $this;
    }

    public function previousEmployer(Employer $employer): static
    {
        $this->previousEmployer = $employer;

        return $this;
    }

    public function license(DriversLicense $driversLicense): static
    {
        $this->driversLicense = $driversLicense;

        return $this;
    }

    protected function formatPhone(string $phone): string
    {
        return str_replace('+', '', $phone);
    }

    public function toArray(): array
    {
        return array_filter([
            'NAME' => $this->name,
            'SSN' => $this->ssn,
            'DOB' => $this->dob,
            'EMAIL' => $this->email,
            'PHONE' => $this->phone,
            'ADDRESS' => $this->address->street,
            'CITY' => $this->address->city,
            'STATE' => $this->address->state,
            'ZIP' => $this->address->zip,
            'CURRENTADDRESSPERIOD' => $this->address->timeAtAddress,
            'PREVADDRESS' => $this->previousAddress?->street,
            'PREVCITY' => $this->previousAddress?->city,
            'PREVSTATE' => $this->previousAddress?->state,
            'PREVZIP' => $this->previousAddress?->zip,
            'PREVADDRESSPERIOD' => $this->previousAddress?->timeAtAddress,
            'HOUSING' => $this->housingType?->value,
            'HOUSINGPAY' => $this->housingPayment,
            'EMPLOYER' => $this->employer?->name,
            'EMPLOYMENTSTATUS' => $this->employer?->status,
            'POSITION' => $this->employer?->position,
            'YEARS' => $this->employer?->years,
            'MONTHS' => $this->employer?->months,
            'WPHONE' => $this->employer?->workPhone,
            'MINCOME' => $this->employer?->monthlyIncome,
            'OTHERINCOME' => $this->employer?->otherIncome,
            'OTHERINCOMEEXPLN' => $this->employer?->otherIncomeExplanation,
            'TYPEOFBUSINESS' => $this->employer?->businessType,
            'PREVEMPLOYER' => $this->previousEmployer?->name,
            'PREVEMPLOYMENTYEARS' => $this->previousEmployer?->years,
            'PREVINCOME' => $this->previousEmployer?->otherIncome,
            'PREVOCCUPATION' => $this->previousEmployer?->occupation,
            'PREVWORKPHONE' => $this->previousEmployer?->workPhone,
            'DRIVERSLICENSENO' => $this->driversLicense?->number,
            'DLEXPIRATION' => $this->driversLicense?->expiration,
            'DLSTATE' => $this->driversLicense?->state,
            'DLCOUNTY' => $this->driversLicense?->county,
        ]);
    }
}
